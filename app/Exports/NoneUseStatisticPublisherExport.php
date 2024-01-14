<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class NoneUseStatisticPublisherExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingStatisticsCntListExcel ?,?,?',
            [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                1,
            ]);

        $title[] = ['도시', '회중명', '전도인ID', '이름', '전화번호'];

        return array_merge($title, $data);
    }
}
