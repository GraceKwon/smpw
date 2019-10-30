<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;


class ActController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function Acts()
    {
        return view('act.acts');
    }

    public function detailActs(Request $request)
    {
        $CancelTypeList = $this->CommonService->getCancelTypeList();
        // dd($CancelTypeList);
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
