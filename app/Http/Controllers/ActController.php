<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ActController extends Controller
{
    public function Acts()
    {
        return view('act.acts');
    }

    public function detailActs(Request $request)
    {
        $res = DB::select('uspGetStandingDailyServicePlanDetail ?', [
            $request->ServiceDate,
        ]);

        foreach($res as $object){
            //모든 ServiceTime을 arrayServiceTime에 담는다
            $arrayServiceTime[] = $object->ServiceTime;

            $DailyServicePlanList[$object->ZoneName][$object->ServiceTime][] = [
                'PublisherName' => $object->PublisherName,
                'LeaderYn' => $object->LeaderYn,
            ];
        }
        if(isset($arrayServiceTime))
            $ServiceTime = [
                'min' => min($arrayServiceTime), //가장 이른 시간
                'max' => max($arrayServiceTime), //가장 늦은 시간
            ];
        // dd($DailyServicePlanList);
        return view('act.detailActs', [
            'DailyServicePlanList' => $DailyServicePlanList ?? [],
            'ServiceTime' => $ServiceTime ?? null,
        ]);
    }

    public function create()
    {
        return view('act.create');
    }
}
