<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class PushService
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function sendToToken($msg, $PublisherIDs)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $title = '[봉사취소안내]';
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($msg)
                            ->setSound('default');
        
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $tokens = DB::table('Publishers')
            ->whereIn('PublisherID' ,$PublisherIDs)
            ->whereNotNull('PushTokenValue')
            ->pluck('PushTokenValue')
            ->toArray();

        if( !empty($tokens) ){
            $downstreamResponse = FCM::sendTo($tokens, $option, $notification);
        }

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
        
        // $downstreamResponse->numberSuccess();
        // $downstreamResponse->numberFailure();
        // $downstreamResponse->numberModification();
        
        // return Array - you must remove all this tokens in your database
        // $downstreamResponse->tokensToDelete();
        
        // return Array (key : oldToken, value : new token - you must change the token in your database)
        // $downstreamResponse->tokensToModify();
        
        // return Array - you should try to resend the message to the tokens in the array
        // $downstreamResponse->tokensToRetry();
        
        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        // $downstreamResponse->tokensWithError();
    }

    public function sendToTopic($msg)
    {
        $title = '[봉사지원요청]';
        $CircuitID =  request()->CircuitID ?? session('auth.CircuitID');
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($msg)
                            ->setSound('default');
        
        $notification = $notificationBuilder->build();
        
        $topic = new Topics();
        $topic->topic($CircuitID);
        
        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
        DB::table('Pushes')->insert([
            'AdminID' => session('auth.AdminID'),
            'PushTitle' => $title,
            'PushMessage' => $msg,
            'PushKindID' => getItemID('지원요청', 'PushKindID'),
            'Topic' => $CircuitID,
            'SendDate' => date('Y-m-d H:i:s'),
            'CreateDate' => date('Y-m-d H:i:s')
        ]);
        // $topicResponse->isSuccess();
        // $topicResponse->shouldRetry();
        // $topicResponse->error();
        // var_dump($topicResponse->isSuccess());

    }

    public function TimeCancel()
    {
        $PublisherIDs = DB::table('ServiceActs')->where([
                ['ServiceDate' , request()->ServiceDate],
                ['ServiceTimeID' , request()->ServiceTimeID],
                ['ServiceZoneID' , request()->ServiceZoneID],
            ])
            ->whereNull('CancelDate')
            ->pluck('PublisherID')
            ->toArray();

        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= sprintfServiceTime( getServiceTime() ). "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }

    public function ZoneCancel()
    {
        $PublisherIDs = DB::table('ServiceActs')->where([
            ['ServiceDate' , request()->ServiceDate],
            ['ServiceZoneID' , request()->ServiceZoneID],
        ])
        ->whereNull('CancelDate')
        ->groupBy('PublisherID')
        ->pluck('PublisherID')
        ->toArray();
        // return $PublisherIDs;
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= '전체시간'. "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }

    public function DayCancel()
    {
        $ServiceZoneIDs = DB::table('ServiceZones')->where([
                ['CircuitID' , ( session('auth.CircuitID') ?? request()->CircuitID )],
                ['UseYn' , 1],
            ])
            ->pluck('ServiceZoneID')
            ->toArray();
      
        $PublisherIDs = DB::table('ServiceActs')->where([
                ['ServiceDate' , request()->ServiceDate],
            ])
            ->whereIn('ServiceZoneID', $ServiceZoneIDs)
            ->whereNull('CancelDate')
            ->groupBy('PublisherID')
            ->pluck('PublisherID')
            ->toArray(); 

        $msg = request()->ServiceDate . "\r\n";
        $msg .= '전체구역' . "\r\n";
        $msg .= '전체시간'. "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }

    public function getArrayForRequestJoin($ServiceZoneID = null)
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
                [ 'ServiceTimes.ServiceTime', '>', (int)date ('H') ],
            ])
            ->havingRaw('COUNT(*) < 6')
            ->whereNull('ServiceActs.CancelDate')
            ->groupBy(['ServiceActs.ServiceTimeID', 'ServiceTimes.ServiceTime'])
            ->get();
       
    }

    public function RequestJoin()
    {
        $res = $this->getArrayForRequestJoin();
       
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        foreach ($res as $row) {
            $msg .= sprintfServiceTime($row->ServiceTime) . ' 필요인원(' . (6 - $row->Cnt) . ')' . "\r\n";
        }
        if( count($res) ) $this->sendToTopic($msg);
    }
    
    public function RequestJoinAllZones()
    {
        $ServiceZoneIDs = DB::table('ServiceZones')->where([
                ['CircuitID' , ( session('auth.CircuitID') ?? request()->CircuitID )],
                ['UseYn' , 1],
            ])
            ->pluck('ServiceZoneID');

        foreach( $ServiceZoneIDs as $ServiceZoneID ){

            $res = $this->getArrayForRequestJoin($ServiceZoneID);
                
            $msg = request()->ServiceDate . "\r\n";
            $msg .= getServiceZoneName($ServiceZoneID) . "\r\n";
            foreach ($res as $row) {
                $msg .= sprintfServiceTime($row->ServiceTime) . ' 필요인원(' . (6 - $row->Cnt) . ')' . "\r\n";
            }
            if( count($res) ) $this->sendToTopic($msg);
        }          
       
    }

}
