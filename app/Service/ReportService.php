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
        $res = DB::select('uspGetStandingDailyServiceReportCnt ?,?', [
            date('Y-m-01', strtotime( request()->SetMonth )),
            ( session('auth.CircuitID') ?? request()->CircuitID ),
        ]);
        foreach($res as $object){
            $array[date('j', strtotime($object->YMD))] = $object;
        }
        
        return $array ?? [];
    }

    public function getDailyServiceReportList()
    {
        $paginate = 30;  
        $page = request()->input('page', 1);

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

    public function getVisitRequestList()
    {
        $paginate = 30;  
        $page = request()->input('page', 1);

        $parameter = [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->CongregationID,
                request()->PublisherName,
                request()->InsteresterName,
                request()->StartDate,
                request()->EndDate,
            ];

        $data = DB::select('uspGetStandingServiceVisitRequestList ?,?,?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));

        $count = DB::select('uspGetStandingServiceVisitRequestListCnt ?,?,?,?,?,?,?', $parameter);
        return setPaginator($paginate, $page, $data, $count);
    }

    public function getExperienceList()
    {
        $paginate = 30;  
        $page = request()->input('page', 1);

        $parameter = [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->AdminName,
                request()->PublisherName,
                request()->BranchConfirmYn,
                request()->StartDate,
                request()->EndDate,
            ];

        $data = DB::select('uspGetStandingServiceExperienceList ?,?,?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));

        $count = DB::select('uspGetStandingServiceExperienceListCnt ?,?,?,?,?,?,?', $parameter);
        return setPaginator($paginate, $page, $data, $count);
    }

    public function getReportProductDetailList()
    {
        return DB::select('uspGetStandingDailyServiceReportProductDetailList ?,?', [
            request()->ServiceTimeID,
            request()->ServiceDate,
        ]);
       
    }

    public function getReportVisitRequestDetailList()
    {
        return DB::select('uspGetStandingDailyServiceReportVisitRequestDetailList ?,?', [
            request()->ServiceTimeID,
            request()->ServiceDate,
        ]);
       
    }

    public function getReportMemoDetailList()
    {
        return DB::select('uspGetStandingDailyServiceReportMemoDetailList ?,?', [
            request()->ServiceTimeID,
            request()->ServiceDate,
        ]);
       
    }


}
