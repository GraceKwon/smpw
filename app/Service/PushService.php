<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
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
        // $optionBuilder = new OptionsBuilder();
        // $optionBuilder->setTimeToLive(60*20);
        $title = '[봉사취소안내]';
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($msg)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            'title' => $title,
            'body' => $msg,
            ]);
        
        // $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $tokens = DB::table('Publishers')
            ->whereIn('PublisherID' ,$PublisherIDs)
            ->whereNotNull('PushTokenValue')
            ->pluck('PushTokenValue')
            ->toArray();
        if( !empty($tokens) ){
            $downstreamResponse = FCM::sendTo($tokens, null, $notification, $data);
            
            if( count($downstreamResponse->tokensToDelete()) ){
                DB::table('Publishers')->whereIn('PushTokenValue', $downstreamResponse->tokensToDelete())->update(['PushTokenValue' => NULL]);
            }
            
            if( count($downstreamResponse->tokensToModify()) ){
                foreach ( $downstreamResponse->tokensToModify() as $oldToken => $newToken ){
                    DB::table('Publishers')
                    ->where(' PushTokenValue', $oldToken )
                    ->update([ 'PushTokenValue' => $newToken ]);
                }
            }
            
            if( count($downstreamResponse->tokensToRetry()) ){
                foreach ( $downstreamResponse->tokensToRetry() as $token ){
                    $downstreamResponse = FCM::sendTo($token, null, $notification, $data);
                }
            }
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
        if( !empty($tokens) ){

            echo('numberSuccess : ');
            var_dump($downstreamResponse->numberSuccess());
            echo('numberFailure : ');
            var_dump($downstreamResponse->numberFailure());
            echo('numberModification : ');
            var_dump($downstreamResponse->numberModification());
        }else{
            echo 'empty($tokens) === true';
        }

        
        // return Array - you must remove all this tokens in your database
        // $downstreamResponse->tokensToDelete();
        
        // return Array (key : oldToken, value : new token - you must change the token in your database)
        // $downstreamResponse->tokensToModify();
        
        // return Array - you should try to resend the message to the tokens in the array
        // $downstreamResponse->tokensToRetry();
        
        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        // $downstreamResponse->tokensWithError();

    }

    public function sendToTopic($title, $msg)
    {
        $CircuitID =  request()->CircuitID ?? session('auth.CircuitID');

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($msg)
                            ->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();

        $addData = [
            'title' => $title,
            'body' => $msg
        ];
        if(request()->NoticeID) $addData['NoticeID'] = request()->NoticeID;
        if(request()->ServiceDate) $addData['ServiceDate'] = request()->ServiceDate;
        if(request()->ServiceZoneID) $addData['ServiceZoneID'] = request()->ServiceZoneID;

        $dataBuilder->addData($addData);

        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $topic = new Topics();
        $topic->topic($CircuitID);
        
        $topicResponse = FCM::sendToTopic($topic, null, $notification, $data);
        if(!$topicResponse->isSuccess() && $topicResponse->shouldRetry()){
            echo('!$topicResponse->isSuccess() && $topicResponse->shouldRetry() === true');
            $topicResponse = FCM::sendToTopic($topic, null, $notification, $data);
        } 
        
        DB::table('Pushes')->insert([
            'AdminID' => session('auth.AdminID'),
            'PushTitle' => $title,
            'PushMessage' => $msg,
            'PushKindID' => getItemID('지원요청', 'PushKindID'),
            'Topic' => $CircuitID,
            'SendDate' => date('Y-m-d H:i:s'),
            'CreateDate' => date('Y-m-d H:i:s')
        ]);
            
        echo('isSuccess : ');
        var_dump($topicResponse->isSuccess());
        echo('shouldRetry : ');
        var_dump($topicResponse->shouldRetry());
        echo('error : ');
        var_dump($topicResponse->error());

    }

    public function PublisherCancel()
    {
        $PublisherIDs = [request()->PublisherID];

        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= sprintfServiceTime( getServiceTime() ). "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }

    public function getPublisherIDsTimeCancel()
    {
        return DB::table('ServiceActs')->where([
                ['ServiceDate' , request()->ServiceDate],
                ['ServiceTimeID' , request()->ServiceTimeID],
                ['ServiceZoneID' , request()->ServiceZoneID],
            ])
            ->whereNull('CancelDate')
            ->pluck('PublisherID')
            ->toArray();
    }

    public function getPublisherIDsZoneCancel()
    {
        return DB::table('ServiceActs')->where([
            ['ServiceDate' , request()->ServiceDate],
            ['ServiceZoneID' , request()->ServiceZoneID],
        ])
        ->whereNull('CancelDate')
        ->groupBy('PublisherID')
        ->pluck('PublisherID')
        ->toArray();
    }

    public function getPublisherIDsDayCancel()
    {
        $ServiceZoneIDs = DB::table('ServiceZones')->where([
                ['CircuitID' , ( session('auth.CircuitID') ?? request()->CircuitID )],
                ['UseYn' , 1],
            ])
            ->pluck('ServiceZoneID')
            ->toArray();
      
        return DB::table('ServiceActs')->where([
                ['ServiceDate' , request()->ServiceDate],
            ])
            ->whereIn('ServiceZoneID', $ServiceZoneIDs)
            ->whereNull('CancelDate')
            ->groupBy('PublisherID')
            ->pluck('PublisherID')
            ->toArray(); 

    }

    public function TimeCancel($PublisherIDs = [])
    {
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= sprintfServiceTime( getServiceTime() ). "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }

    public function ZoneCancel($PublisherIDs = [])
    {
        $msg = request()->ServiceDate . "\r\n";
        $msg .= getServiceZoneName() . "\r\n";
        $msg .= '전체시간'. "\r\n";
        $msg .= '봉사일정취소 사유( ' . getItem( request()->CancelTypeID, 'CancelTypeID' ) . ' )';

        $this->sendToToken($msg, $PublisherIDs);
    }


    public function DayCancel($PublisherIDs = [])
    {
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
            ])
            ->when( request()->ServiceDate === date('Y-m-d') , function ($query) {
                return $query->where('ServiceTimes.ServiceTime', '>', (int)date('H') );
            })
            ->havingRaw('COUNT(*) < ' . session('auth.PublisherNumber'))
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
            $msg .= sprintfServiceTime($row->ServiceTime) . ' 필요인원(' . ( session('auth.PublisherNumber') - $row->Cnt ) . ')' . "\r\n";
        }
        // return $res;
        if( count($res) ) $this->sendToTopic('[봉사지원요청]' ,$msg);
    }
    
    public function RequestJoinAllZones()
    {
        $ServiceZoneIDs = DB::table('ServiceZones')->where([
                ['CircuitID' , ( session('auth.CircuitID') ?? request()->CircuitID )],
                ['UseYn' , 1],
            ])
            ->pluck('ServiceZoneID');

        foreach( $ServiceZoneIDs as $ServiceZoneID ){
            request()->ServiceZoneID = $ServiceZoneID;
            $this->RequestJoin();
        }          
       
    }

    public function newNotice()
    {
        $msg = '새로운 공지사항이 등록되었습니다.' . "\r\n";
  
        $this->sendToTopic('[공지사항]' ,$msg);
    }

}
