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
        
        $notificationBuilder = new PayloadNotificationBuilder('봉사취소안내');
        $notificationBuilder->setBody($msg)
                            ->setSound('default');
        
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $tokens = DB::table('Publishers')
            ->whereIn('PublisherID' ,$PublisherIDs)
            ->whereNotNull('PushTokenValue')
            ->pluck('PushTokenValue')
            ->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification);
        
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        
        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();
        
        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();
        
        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
        
        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();
        var_dump($downstreamResponse);
    }

    public function RequestPushTimeCancel()
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

    public function RequestPushZoneCancel()
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

    public function RequestPushDayCancel()
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

    public function getArrayRequiredServiceTime()
    {
        request()->ServiceZoneID = 1;
        request()->ServiceDate = '2019-11-04';
        $res = DB::table('ServiceTimes')
            ->select(
                // 'ServiceTimes.ServiceZoneID',
                // 'ServiceTimes.ServiceTimeID',
                'ServiceTimes.ServiceTime',
                'ServiceActs.ServiceTimeID',
                DB::raw('ServiceActs.CC')
            )
            ->leftjoin('ServiceActs', function ($join) {
                $join->on('ServiceTimes.ServiceTimeID', '=', 'ServiceActs.ServiceTimeID')
                    ->select(DB::raw('COUNT(*) as CC'))
                    ->whereNull('CancelDate')
                    ->whereYear('ServiceDate', date('Y', strtotime( request()->ServiceDate )))
                    ->whereMonth('ServiceDate', date('m', strtotime( request()->ServiceDate )))
                    ->whereDay('ServiceDate', date('d', strtotime( request()->ServiceDate )));
            })
            ->where([
                [ 'ServiceTimes.ServiceZoneID', request()->ServiceZoneID ],
                [ 'ServiceTimes.ServiceZoneID', request()->ServiceZoneID ],
                [ 'ServiceTimes.ServiceYoil', getWeekName(  date('w', strtotime( request()->ServiceDate )) )],
            ])
            ->whereNull('ServiceActs.ServiceTimeID')
            ->groupBy(['ServiceActs.ServiceTimeID', 'ServiceTimes.ServiceTime'])
            ->get();
        dd($res);
       
    }

}
