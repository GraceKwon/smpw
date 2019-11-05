<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ActService;


class ActController extends Controller
{
    public function __construct(CommonService $CommonService, ActService $ActService)
    {
        $this->CommonService = $CommonService;
        $this->ActService = $ActService;
        $this->middleware('admin_auth');
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
            'SetMonth' => $request->SetMonth,
            'lastDay' => date('t', strtotime($request->SetMonth)),
            'firstWeek' => date('w', strtotime($request->SetMonth)),
        ]);
    }

    public function detailActs(Request $request)
    {
        $getArrayServiceTime = $this->ActService->getArrayServiceTime();
        
        return view('act.detailActs', [
            'max' => $getArrayServiceTime['max'],
            'min' => $getArrayServiceTime['min'],
            'ServiceTimeList' => $getArrayServiceTime['ServiceTimeList'],
            'dailyServicePlanDetail' => $this->ActService->getDailyServicePlanDetail(),
            'CancelTypeList' => $this->CommonService->getCancelTypeList(),
        ]);
    }

    public function create()
    {
        return view('act.create');
    }
}
