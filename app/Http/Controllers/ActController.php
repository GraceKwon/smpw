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

    public function detailActs()
    {
        $res = DB::select('uspGetStandingDailyServicePlanDetail ?', [
            date('Y-m-d'),
        ]);
        foreach($res as $object){
            $DailyServicePlanList[$object->ZoneName][$object->ServiceTime][] = [
                'PublisherName' => $object->PublisherName,
                'LeaderYn' => $object->LeaderYn,
            ];
        }
        dd($DailyServicePlanList);
        return view('act.detailActs', [
            'DailyServicePlanList' => $DailyServicePlanList,
        ]);
    }

    public function create()
    {
        return view('act.create');
    }
}
