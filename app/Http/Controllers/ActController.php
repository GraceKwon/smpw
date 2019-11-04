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
    }

    public function Acts(Request $request)
    {
    
        $lastDay = date('t', strtotime($request->SetMonth));
        $firstWeek = date('w', strtotime($request->SetMonth));
        $dailyServicePlanCnt = $this->ActService->getDailyServicePlanCnt();
        // dd($dailyServicePlanCnt);
        return view('act.acts', [
            'SetMonth' => $request->SetMonth,
            'dailyServicePlanCnt' => $dailyServicePlanCnt,
            'lastDay' => $lastDay,
            'firstWeek' => $firstWeek,
        ]);
    }

    public function detailActs(Request $request)
    {
        $CancelTypeList = $this->CommonService->getCancelTypeList();
        // dd($CancelTypeList);
        // $ServiceDate = $request->SetMonth . '-' . sprintf("%02d", $request->day );
        $res = DB::select('uspGetStandingDailyServicePlanDetail ?', [
            $request->ServiceDate,
        ]);

        foreach($res as $object){
            //모든 ServiceTime을 arrayServiceTime에 담는다
            $arrayServiceTime[] = $object->ServiceTime;

            // $DailyServicePlanList[$object->ZoneName][$object->ServiceTime][] = $object;
            $DailyServicePlanList[$object->ZoneName]['ServiceZoneID'] = $object->ServiceZoneID;
            $DailyServicePlanList[$object->ZoneName][$object->ServiceTime][] = $object;
        }
        // dd($res);
        if(isset($arrayServiceTime))
            $ServiceTime = [
                'min' => min($arrayServiceTime), //가장 이른 시간
                'max' => max($arrayServiceTime), //가장 늦은 시간
            ];
        // dd($DailyServicePlanList);
        return view('act.detailActs', [
            'DailyServicePlanList' => $DailyServicePlanList ?? [],
            'ServiceTime' => $ServiceTime ?? null,
            'CancelTypeList' => $CancelTypeList ?? null,
        ]);
    }

    public function create()
    {
        return view('act.create');
    }
}
