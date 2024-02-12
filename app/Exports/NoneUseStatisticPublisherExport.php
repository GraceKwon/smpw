<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class NoneUseStatisticPublisherExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingPublisheAbsentListExcel ?,?,?',
            [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->Month,
            ]);

        $title[] = ['전도인ID', '도시', '순회구', '회중', '이름', '성별', '봉사자현황', '상태', '전화번호', '최종봉사일자'];

        return array_merge($title, $data);
    }
}
