<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class StatisticPublisherExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingStatisticsPublisherListExcel ?,?,?,?', 
            [
                request()->TypeID ?? '1',
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->CongregationID,
            ]);
        
        $title[] = ['도시', '지역', '회중', '형제', '자매', '정규p', '고정봉사자', '1년내참여자', '장기미참여자'];

        return array_merge($title, $data);

    }
}
