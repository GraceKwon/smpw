<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;

class ReportsExport implements FromArray, WithTitle
{
    public function title(): string
    {
        return request()->ServiceDate;
    }
    public function array(): array
    {
        $data = DB::select('uspGetStandingDailyServiceReportListExcel ?,?,?,?', 
            [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->ServiceZoneID,
                request()->ServiceDate,
            ]);

        foreach ($data as $row) {
            $row->ServiceTime = sprintfServiceTime($row->ServiceTime);
            $row->VisitRequestQty = (string)$row->PlacementQty;
            $row->VisitRequestQty = (string)$row->VideoShowQty;
            $row->VisitRequestQty = (string)$row->VisitRequestQty;
        }
        
        $title[] = ['시간대', '구역', '보고자', '출판물', '동영상', '방문요청'];

        return array_merge($title, $data);

    }
}
