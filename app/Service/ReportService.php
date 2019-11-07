<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function __construct()
    {
    }

    public function getDailyServiceReportCnt()
    {
        $res = DB::select('uspGetStandingDailyServiceReportCnt ?', [
            date('Y-m-01', strtotime( request()->SetMonth )),
        ]);
        foreach($res as $object){
            $array[date('j', strtotime($object->YMD))] = $object;
        }
        // dd($array);
        return $array ?? [];
    }

    public function getDailyServiceReportList()
    {
        $paginate = 1;  
        $page = (int)request()->input('page', '1');

        $parameter = [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->ServiceZoneID,
                request()->ServiceDate,
            ];

        $data = DB::select('uspGetStandingDailyServiceReportList ?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));

        $count = DB::select('uspGetStandingDailyServiceReportListCnt ?,?,?,?', $parameter);
            // dd($count);
        return setPaginator($paginate, $page, $data, $count);
    }



}
