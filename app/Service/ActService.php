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

    public function modalPublisherSearch()
    {
        // return request();
        return DB::table('Publishers')->select('PublisherName', 'PublisherID')->where('PublisherName' ,'like', '%' . request()->PublisherName . '%')->get();
        // return DB::table('Publishers')->where('PublisherName' ,request()->PublisherName)->get();
        // $res = DB::select('uspSetPublisherServicePlanInsert ?,?,?,?,?,?', [
        //     ,
        // ]);
    }



}
