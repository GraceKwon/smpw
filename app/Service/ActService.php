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
        return $array ?? [];
    }

    public function setPublisherServicePlanInsert()
    {
 
        DB::select('uspSetPublisherServicePlanInsert ?,?,?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->PublisherID,
            request()->LeaderYn,
            request()->WaitingYn,
            request()->ServiceDate,
        ]);
    }

    public function modalPublisherSearch()
    {
        if ( request()->PublisherName ) {

            $CircuitID = DB::table('ServiceZones')->where('ServiceZoneID', request()->ServiceZoneID)->value('CircuitID');
            $paginate = 5;  
            $page = request()->input('page', '1');
            $parameter = [
                null,
                $CircuitID,
                null,
                request()->PublisherName,
                null,
                null,
                0,
            ];

            $data = DB::select('uspGetStandingPublisherList ?,?,?,?,?,?,?,?,?', 
                array_merge( [$paginate, $page], $parameter ));
            $count = DB::select('uspGetStandingPublisherListCnt ?,?,?,?,?,?,?', $parameter);
            $count = getTotalCnt($count);
            $lastPage = ceil($count / $paginate);
  
            return [
                'data' => $data,
                'lastPage' => $lastPage,
            ];
        } 
        else
            return ['data' => []];
    
    }



}
