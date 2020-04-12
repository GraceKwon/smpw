<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class StatisticProductExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingStatisticsProductList ?,?,?,?,?,?',
            [
                request()->TypeID,
                (session('auth.MetroID') ?? request()->MetroID),
                (session('auth.CircuitID') ?? request()->CircuitID),
                request()->LanguageName,
                request()->StartDate,
                request()->EndDate,
            ]);

        if( request()->TypeID === '1') $title[] = ['출판물', '언어', '배부/반영' ];
        if( request()->TypeID === '2') $title[] = ['언어', '출판물배부', '동영상방영'] ;
        return array_merge($title, $data) ;

    }
}
