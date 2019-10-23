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
        // return request()->SetMonth;
        $res = DB::select('uspGetStandingDailyServiceReportCnt ?', [
            date('Y-m-01', strtotime( request()->SetMonth )),
        ]);
        return $res;
    }



}
