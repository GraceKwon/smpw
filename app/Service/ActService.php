<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class ActService
{
    public function __construct()
    {
    }

    public function getDailyServicePlanCnt()
    {
        $res = DB::select('uspGetStandingDailyServicePlanCnt ?', [
            date('Y-m-01', strtotime( request()->SetMonth )),
        ]);
        foreach($res as $object){
            $array[date('j', strtotime($object->ServiceDate))] = $object;
        }
        return $array;
    }

    public function setPublisherServicePlanInsert()
    {
        return request();
        // $res = DB::select('uspSetPublisherServicePlanInsert ?,?,?,?,?,?', [
        //     ,
        // ]);
    }



}
