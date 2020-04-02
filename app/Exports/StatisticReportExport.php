<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class StatisticReportExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingStatisticsReportList ?,?,?,?,?',
            [
                request()->TypeID,
                (session('auth.MetroID') ?? request()->MetroID),
                (session('auth.CircuitID') ?? request()->CircuitID),
                request()->StartDate,
                request()->EndDate,
            ]);

        $total = ['ProductCnt' => 0,'VideoCnt' => 0,'VisitRequestCnt' => 0,'ExperienceCnt' => 0];
        foreach($data as $row){
            $total['ProductCnt'] += $row->ProductCnt;
            $total['VideoCnt'] += $row->VideoCnt;
            $total['VisitRequestCnt'] += $row->VisitRequestCnt;
            $total['ExperienceCnt'] += $row->ExperienceCnt;
        }
        
        $title[] = ['도시', '지역', '출판물', '동영상', '방문요청', '경험담'];
        $row_total[] = ['합계', '', $total['ProductCnt'], $total['VideoCnt'], $total['VisitRequestCnt'], $total['ExperienceCnt']];
        return array_merge($title, $data, $row_total) ;

    }
}
