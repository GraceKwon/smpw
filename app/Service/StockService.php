<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function __construct()
    {
    }

    // public function getDailyServiceReportCnt()
    // {
    //     $res = DB::select('uspGetStandingDailyServiceReportCnt ?', [
    //         date('Y-m-01', strtotime( request()->SetMonth )),
    //     ]);
    //     foreach($res as $object){
    //         $array[date('j', strtotime($object->YMD))] = $object;
    //     }
        
    //     return $array ?? [];
    // }

    // public function getDailyServiceReportList()
    // {
    //     $paginate = 30;  
    //     $page = request()->input('page', 1);

    //     $parameter = [
    //             ( session('auth.MetroID') ?? request()->MetroID ),
    //             ( session('auth.CircuitID') ?? request()->CircuitID ),
    //             request()->ServiceZoneID,
    //             request()->ServiceDate,
    //         ];

    //     $data = DB::select('uspGetStandingDailyServiceReportList ?,?,?,?,?,?', 
    //         array_merge( [$paginate, $page], $parameter ));

    //     $count = DB::select('uspGetStandingDailyServiceReportListCnt ?,?,?,?', $parameter);
    //         // dd($count);
    //     return setPaginator($paginate, $page, $data, $count);
    // }

    public function getProductStockList()
    {
        $paginate = 30;  
        $page = request()->input('page', 1);

        $parameter = [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->ProductID,
                request()->StartDate,
                request()->EndDate,
            ];

        $data = DB::select('uspGetStandingProductStockList ?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));

        $count = DB::select('uspGetStandingProductStockListCnt ?,?,?,?,?', $parameter);
        return setPaginator($paginate, $page, $data, $count);
    }

    public function getProductList()
    {
        return DB::select('uspGetStandingProductList ?', [
            request()->LanguageName ?? '한국어',
        ]);
       
    }
    // public function getExperienceList()
    // {
    //     $paginate = 30;  
    //     $page = request()->input('page', 1);

    //     $parameter = [
    //             ( session('auth.MetroID') ?? request()->MetroID ),
    //             ( session('auth.CircuitID') ?? request()->CircuitID ),
    //             request()->AdminName,
    //             request()->PublisherName,
    //             request()->BranchConfirmYn,
    //             request()->StartDate,
    //             request()->EndDate,
    //         ];

    //     $data = DB::select('uspGetStandingServiceExperienceList ?,?,?,?,?,?,?,?,?', 
    //         array_merge( [$paginate, $page], $parameter ));

    //     $count = DB::select('uspGetStandingServiceExperienceListCnt ?,?,?,?,?,?,?', $parameter);
    //     return setPaginator($paginate, $page, $data, $count);
    // }

    // public function getReportProductDetailList()
    // {
    //     return DB::select('uspGetStandingDailyServiceReportProductDetailList ?,?', [
    //         request()->ServiceTimeID,
    //         request()->ServiceDate,
    //     ]);
       
    // }



}
