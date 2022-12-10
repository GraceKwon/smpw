<?php

namespace App\Http\Controllers;

use App\Rules\AfterToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ActService;
use App\Service\PushService;

class ActController extends Controller
{
    public function __construct(CommonService $CommonService, ActService $ActService, PushService $PushService)
    {
        $this->CommonService = $CommonService;
        $this->ActService = $ActService;
        $this->PushService = $PushService;
        $this->middleware('admin_auth')
            ->except(['modalPublisherCancel',
                'modalTimeCancel',
                'modalZoneCancel',
                'modalDayCancel',
                'modalPushTime',
                'modalPush',
                'modalPushAllZones',
                ]);
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

    public function putCreate(Request $request)
    {
        $request->validate([
            'ReSetStartDate' => [
                'required',
                'date',
                new AfterToday
            ],
        ]);
        DB::statement('uspSetStandingServiceActReInsert ?,?', [
            session('auth.CircuitID'),
            $request->ReSetStartDate,
        ]);
        return view('act.create');
    }

    public function modalPublisherCancel()
    {
        if($this->ActService->setPublisherServicePlanCancel())
            return $this->PushService->PublisherCancel();
    }

    public function modalTimeCancel()
    {
        $PublisherIDs = $this->PushService->getPublisherIDsTimeCancel();
        if($this->ActService->setServiceTimeCancel())
            return $this->PushService->TimeCancel($PublisherIDs);
    }

    public function modalZoneCancel()
    {
        $PublisherIDs = $this->PushService->getPublisherIDsZoneCancel();
        if($this->ActService->setServiceZoneCancel())
            return $this->PushService->ZoneCancel($PublisherIDs);
    }

    public function modalDayCancel()
    {
        $PublisherIDs = $this->PushService->getPublisherIDsDayCancel();
        if($this->ActService->setServiceDayCancel())
            return $this->PushService->DayCancel($PublisherIDs);

    }

    public function modalPushTime()
    {
        return $this->PushService->RequestJoinTime();
    }

    public function modalPush()
    {
        return $this->PushService->RequestJoin();
    }

    public function modalPushAllZones()
    {
        return $this->PushService->RequestJoinAllZones();
    }

}
