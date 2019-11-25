<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ActService;
use App\Service\PushService;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class ActController extends Controller
{
    public function __construct(CommonService $CommonService, ActService $ActService, PushService $PushService)
    {
        $this->CommonService = $CommonService;
        $this->ActService = $ActService;
        $this->PushService = $PushService;
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

    public function modalTimeCancel()
    {
        // $this->ActService->setServiceTimeCancel();
        $this->PushService->TimeCancel();
    }

    public function modalZoneCancel()
    {
        // $this->ActService->setServiceTimeCancel();
        return $this->PushService->ZoneCancel();
    }

    public function modalDayCancel()
    {
        // $this->ActService->setServiceTimeCancel();
        return $this->PushService->DayCancel();
    }

    public function modalPush()
    {
        // $this->ActService->setServiceTimeCancel();
        return $this->PushService->RequestJoin();
    }

    public function modalPushAllZones()
    {
        // $this->ActService->setServiceTimeCancel();
        return $this->PushService->RequestJoinAllZones();
    }



}
