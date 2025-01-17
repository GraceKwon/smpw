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
            $metroId = request()->MetroID ?? session('auth.MetroID');
            $adminRoleId = session('auth.AdminRoleID');

            // CircuitID 또는 MetroID 기반으로 topic 설정
            if ($adminRoleId === 5) {
                $circuitIDs = DB::table('Circuits')
                    ->where('MetroID', $metroId)
                    ->pluck('CircuitID')
                    ->toArray();
                $topicArea = $metroId;
            } else {
                $circuitIDs = [$CircuitID];
                $topicArea = $CircuitID;
            }

            // Congregation IDs 조회
            $congID = DB::table('Congregations')
                ->whereIn('CircuitID', $circuitIDs)
                ->where('UseYn', 1)
                ->pluck('CongregationID')
                ->toArray();

            // Firebase 초기화
            $firebase = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_API_KEY')));
            $messaging = $firebase->createMessaging();

            if (!empty($congID) && count($congID) > 0) {
                // Device 토큰 조회
                $deviceToken = DB::table('Publishers')
                    ->whereIn('CongregationID', $congID)
                    ->where('UseYn', 1)
                    ->where('PushTokenValue', '!=', '')  // 빈 문자열 제외
                    ->where('PushTokenValue', '!=', 'null')  // 문자열 'null' 제외
                    ->where('PushTokenValue', '!=', 'undefined')  // 문자열 'undefined' 제외
                    ->whereRaw('PushTokenValue IS NOT NULL')  // NULL 값 제외
                    ->pluck('PushTokenValue')
                    ->toArray();

                if (!empty($deviceToken)) {
                    // 토큰을 1000개씩 나누어 처리
                    $tokenChunks = array_chunk($deviceToken, 1000);

                    foreach ($tokenChunks as $index => $tokenGroup) {
                        try {
                            // Topic 구독 응답 확인 로그 추가
                            $messaging->subscribeToTopic($topicArea, $tokenGroup);
                        } catch (\Exception $e) {
                            \Log::error('Failed to subscribe chunk ' . ($index + 1), [
                                'error' => $e->getMessage()
                            ]);
                            continue;  // 실패해도 다음 청크 처리
                        }
                    }

                    // 알림 메시지 설정
                    $notification = [
                        'title' => $title,
                        'body' => $msg,
                    ];

                    // 메시지 전송
                    $message = CloudMessage::withTarget('topic', $topicArea)
                        ->withNotification($notification)
                        ->withDefaultSounds()
                        ->withData([
                            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            'type' => 'notice'
                        ]);

                    $response = $messaging->send($message);

                    // 푸시 기록 저장
                    if (!empty($response['name'])) {
                        DB::table('Pushes')->insert([
                            'AdminID' => session('auth.AdminID'),
                            'PushTitle' => $title,
                            'PushMessage' => $msg,
                            'PushKindID' => getItemID('지원요청', 'PushKindID'),
                            'Topic' => $topicArea,
                            'SendDate' => date('Y-m-d H:i:s'),
                            'CreateDate' => date('Y-m-d H:i:s')
                        ]);
                    }
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
     * @return void
     */
    public function newNotice(): void
    {
        $msg = __('msg.NEW_NOTICE'). "\r\n";

        $this->subscribeToTopic('['.__('msg.NOTICE').']', $msg);
    }

    /**
     * @param array $arrayForPush
     * @return void
     */
    public function PublisherServiceTimeSet(array $arrayForPush): void
    {
        $PublisherIDs = [request()->PublisherID];
        $title = '['.__('msg.SERVICE_SCH_NOTI').']';
        $msg = __('msg.SERVICE_REG_SCH');
        foreach ($arrayForPush as $value) {
            $msg .= "\r\n".$value['ZoneName'];
            $msg .= " ".$value['ServiceYoil'];
            $msg .= " ".sprintfServiceTime($value['ServiceTime']);
            $msg .= " ".$value['ServiceSetType'];
        }
        $msg .= "\r\n";
        $msg .= __('msg.START_CHANGE_SCH').' :'.request()->SetStartDate;

        $this->sendToPush($title, $msg, $PublisherIDs);
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
