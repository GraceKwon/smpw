<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ActService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class ActController extends Controller
{
    public function __construct(CommonService $CommonService, ActService $ActService)
    {
        $this->CommonService = $CommonService;
        $this->ActService = $ActService;
        // $this->middleware('admin_auth');
    }

    public function Acts(Request $request)
    {
        if($request->SetMonth === null) $request->SetMonth = date('Y-m');

        if($request->MetroID === null 
            && session('auth.MetroID') == null){
            $request->MetroID = $this->CommonService->getMetroList()[0]->MetroID ?? '';
        }

        if($request->CircuitID === null 
            && session('auth.CircuitID') === null){
            $request->CircuitID = $this->CommonService->getCircuitList()[0]->CircuitID ?? '';
        }
        
        return view('act.acts', [
            'MetroList' => $this->CommonService->getMetroList(),
            'CircuitList' => $this->CommonService->getCircuitList(),
            'dailyServicePlanCnt' => $this->ActService->getDailyServicePlanCnt(),
            'lastDay' => date('t', strtotime($request->SetMonth)),
            'firstWeek' => date('w', strtotime($request->SetMonth)),
        ]);
    }

    public function detailActs(Request $request)
    {
        $arrayServiceTime = $this->ActService->getArrayServiceTime();
        
        return view('act.detailActs', [
            'max' => $arrayServiceTime['max'],
            'min' => $arrayServiceTime['min'],
            'ServiceTimeList' => $arrayServiceTime['ServiceTimeList'],
            'ServicePlanDetail' => $this->ActService->getDailyServicePlanDetail(),
            'CancelTypeList' => $this->CommonService->getCancelTypeList(),
        ]);
    }

    public function create()
    {
        return view('act.create');
    }

    public function fcm()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        $notificationBuilder = new PayloadNotificationBuilder('제목');
        $notificationBuilder->setBody('Hello world')
                            ->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        // You must change it to get your tokens
        $tokens = DB::table('Publishers')->where('Account','AAA001')->orwhere('Account', 'skkim')
            ->whereNotNull('PushTokenValue')->pluck('PushTokenValue')->toArray();
        // ->toArray();

        // dd($tokens);
        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        
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
        // var_dump($downstreamResponse->numberSuccess());
        // var_dump($downstreamResponse->numberFailure());
        // var_dump($downstreamResponse->numberModification());

        // var_dump($downstreamResponse->tokensToDelete());
        // var_dump($downstreamResponse->tokensToModify());
        // var_dump($downstreamResponse->tokensToRetry());
        // var_dump($downstreamResponse->tokensWithError());
    }

    public function fcmtopic()
    {
        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
                            ->setSound('default');
        
        $notification = $notificationBuilder->build();
        
        $topic = new Topics();
        $topic->topic('1');
        
        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
        
        var_dump($topicResponse->isSuccess());
        var_dump($topicResponse->shouldRetry());
        var_dump($topicResponse->error());

    }



}
