<?php

namespace App\Service;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;

class PushNewService
{
    public function __construct(CommonService $CommonService)
    {
        $this->locale = App::getLocale();
        $this->CommonService = $CommonService;
    }

    /**
     * @param $title
     * @param $msg
     * @param array $PublisherIDs
     * @return void
     */
    public function sendToPush($title, $msg, array $PublisherIDs): void
    {
        try {
            $firebase = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_API_KEY')));
            $messaging = $firebase->createMessaging();

            $tokens = DB::table('Publishers')
                ->whereIn('PublisherID' ,$PublisherIDs)
                ->whereNotNull('PushTokenValue')
                ->pluck('PushTokenValue')
                ->toArray();

            if (!empty($tokens)) {
                $notification = [
                    'title' => $title,
                    'body' => $msg,
                ];
                $message = CloudMessage::new()->withNotification($notification)
                    ->withDefaultSounds();

                $response = $messaging->sendMulticast($message, $tokens);

                if ($response->count() > 0) {
                    $insertArray = [];
                    foreach ($PublisherIDs as $PublisherID) {
                        $insertArray[] = [
                            'AdminID' => session('auth.AdminID'),
                            'PushTitle' => $title,
                            'PushMessage' => $msg,
                            'PublisherID' => $PublisherID,
                            'PushKindID' => getItemID('일정취소', 'PushKindID'),
                            'SendDate' => date('Y-m-d H:i:s'),
                            'CreateDate' => date('Y-m-d H:i:s')
                        ];
                    }

                    DB::table('Pushes')->insert($insertArray);
                }
            }
        } catch (MessagingException|FirebaseException $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * @param $title
     * @param $msg
     * @return void
     */
    public function subscribeToTopic($title, $msg): void
    {
        try {
            $CircuitID = request()->CircuitID ?? session('auth.CircuitID');

            $congID = DB::table('Congregations')->where('CircuitID', $CircuitID)
                ->where('UseYn', 1)
                ->pluck('CongregationID')
                ->toArray();

            $firebase = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_API_KEY')));
            $messaging = $firebase->createMessaging();

            if (!empty($congID) && count($congID) > 0) {
                $deviceToken = DB::table('Publishers')->whereIn('CongregationID', $congID)
                    ->where('UseYn', 1)
                    ->whereNotNull('PushTokenValue')
                    ->pluck('PushTokenValue')
                    ->toArray();

                //create subscribeToTopic
                $messaging->subscribeToTopic($CircuitID, $deviceToken);

                //send topic
                $notification = [
                    'title' => $title,
                    'body' => $msg,
                ];
                $message = CloudMessage::withTarget('topic', $CircuitID)
                    ->withNotification($notification)
                    ->withDefaultSounds();

                $response = $messaging->send($message);
                if (!empty($response['name'])) {
                    DB::table('Pushes')->insert([
                        'AdminID' => session('auth.AdminID'),
                        'PushTitle' => $title,
                        'PushMessage' => $msg,
                        'PushKindID' => getItemID('지원요청', 'PushKindID'),
                        'Topic' => $CircuitID,
                        'SendDate' => date('Y-m-d H:i:s'),
                        'CreateDate' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        } catch (MessagingException|FirebaseException $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * @return void
     */
    #[NoReturn] public function RequestJoin(): void
    {
        $res = $this->getArrayForRequestJoin();

        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        foreach ($res as $row) {
            $msg .= sprintfServiceTime($row->ServiceTime).' '.__('msg.NEED_SMPW').'(';
            $msg .= ( session('auth.PublisherNumber') - $row->Cnt ) . ')' . "\r\n";
        }

        if( count($res) ) $this->subscribeToTopic('['.__('msg.REQUEST_SMPW').']' ,$msg);
    }


    /**
     * @param array $PublisherIDs
     * @return void
     */
    public function DayCancel(array $PublisherIDs): void
    {
        $title = '['.__('msg.CANCEL_SERVICE_NOTI').']';
        $msg = request()->ServiceDate . "\r\n";
        $msg .= __('msg.WHOLE_SECTION') . "\r\n";
        $msg .= __('msg.WHOLE_TIME'). "\r\n";
        $msg .= __('msg.CANCEL_SERVICE_SCH').' '.__('msg.CR').' ( ';
        $msg .= getItemByLocale(request()->CancelTypeID, 'CancelTypeID', $this->locale) . ' )';

        $this->sendToPush($title, $msg, $PublisherIDs);
    }

    /**
     * @param array $PublisherIDs
     * @return void
     */
    public function ZoneCancel(array $PublisherIDs): void
    {
        $title = '[' . __('msg.CANCEL_SERVICE_NOTI') . ']';
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= __('msg.WHOLE_TIME'). "\r\n";
        $msg .= __('msg.CANCEL_SERVICE_SCH') . ' ' . __('msg.CR') . ' ( ';
        $msg .= getItemByLocale(request()->CancelTypeID, 'CancelTypeID', $this->locale) . ' )';

        $this->sendToPush($title, $msg, $PublisherIDs);
    }

    /**
     * @param array $PublisherIDs
     * @return void
     */
    public function TimeCancel(array $PublisherIDs): void
    {
        $this->extracted($PublisherIDs);
    }

    /**
     * @return void
     */
    public function PublisherCancel(): void
    {
        $PublisherIDs = [request()->PublisherID];
        $this->extracted($PublisherIDs);
    }

    /**
     * @return void
     */
    public function RequestJoinAllZones(): void
    {
        $ServiceZoneIDs = DB::table('ServiceZones')->where([
                ['CircuitID' , ( session('auth.CircuitID') ?? request()->CircuitID )],
                ['UseYn' , 1],
            ])->pluck('ServiceZoneID');

//        dd($ServiceZoneIDs);

        foreach( $ServiceZoneIDs as $ServiceZoneID ){
            request()->ServiceZoneID = $ServiceZoneID;
            $this->RequestJoin();
        }
    }

    /**
     * @return void
     */
    public function RequestJoinTime(): void
    {
        $res = DB::table('ServiceActs')
            ->select(
                'ServiceTimes.ServiceTime',
                DB::raw('COUNT(*) AS Cnt')
            )
            ->leftJoin('ServiceTimes', 'ServiceTimes.ServiceTimeID', 'ServiceActs.ServiceTimeID')
            ->where([
                [ 'ServiceActs.ServiceTimeID', request()->ServiceTimeID ],
                [ 'ServiceActs.ServiceZoneID', request()->ServiceZoneID ],
                [ 'ServiceActs.ServiceDate', date ('Y-m-d H:i:s' , strtotime(request()->ServiceDate) ) ],
            ])
            ->when( request()->ServiceDate === date('Y-m-d') , function ($query) {
                return $query->where('ServiceTimes.ServiceTime', '>', (int)date('H') );
            })
            ->havingRaw('COUNT(*) < ' . session('auth.PublisherNumber'))
            ->whereNull('ServiceActs.CancelDate')
            ->groupBy(['ServiceActs.ServiceTimeID', 'ServiceTimes.ServiceTime'])
            ->get();

        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        foreach ($res as $row) {
            $msg .= sprintfServiceTime($row->ServiceTime).' '.__('msg.NEED_SMPW').'(';
            $msg .= ( session('auth.PublisherNumber') - $row->Cnt ) . ')' . "\r\n";
        }

        if( count($res) ) $this->subscribeToTopic('['.__('msg.REQUEST_SMPW').']' ,$msg);
    }


    /**
     * @param $ServiceZoneID
     * @return Collection
     */
    public function getArrayForRequestJoin($ServiceZoneID = null): Collection
    {
        return DB::table('ServiceActs')
            ->select(
                'ServiceTimes.ServiceTime',
                DB::raw('COUNT(*) AS Cnt')
            )
            ->leftJoin('ServiceTimes', 'ServiceTimes.ServiceTimeID', 'ServiceActs.ServiceTimeID')
            ->where([
                [ 'ServiceActs.ServiceZoneID', $ServiceZoneID ?? request()->ServiceZoneID ],
                [ 'ServiceActs.ServiceDate', date ('Y-m-d H:i:s' , strtotime(request()->ServiceDate) ) ],
            ])
            ->when( request()->ServiceDate === date('Y-m-d') , function ($query) {
                return $query->where('ServiceTimes.ServiceTime', '>', (int)date('H') );
            })
            ->havingRaw('COUNT(*) < ' . session('auth.PublisherNumber'))
            ->whereNull('ServiceActs.CancelDate')
            ->groupBy(['ServiceActs.ServiceTimeID', 'ServiceTimes.ServiceTime'])
            ->get();
    }

    /**
     * @param mixed $PublisherIDs
     * @return void
     */
    public function extracted(mixed $PublisherIDs): void
    {
        $title = '['.__('msg.CANCEL_SERVICE_NOTI').']';
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= sprintfServiceTime(getServiceTime()) . "\r\n";
        $msg .= __('msg.CANCEL_SERVICE_SCH') . ' ' . __('msg.CR') . ' ( ';
        $msg .= getItemByLocale(request()->CancelTypeID, 'CancelTypeID', $this->locale) . ' )';

        $this->sendToPush($title, $msg, $PublisherIDs);
    }

}
