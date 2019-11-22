<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class ProductStockExport implements FromArray
{
    public function array(): array
    {
        $data = DB::select('uspGetStandingProductStockListExcel ?,?,?,?,?', 
            [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->ProductID,
                request()->ServiceZoneID,
                request()->ServiceDate,
            ]);
        // foreach ($data as $row) {
        //     $row->ServiceTime = sprintfServiceTime($row->ServiceTime);
        //     if($row->ReportYn === 1
        //         || $row->PlacementQty > 0
        //         || $row->VideoShowQty > 0
        //         || $row->VisitRequestQty > 0)
                
        //         $row->ReportYn = 'O';
        //     else
        //         $row->ReportYn = 'X';

        // }
        
        $title[] = ['도시', '지역', '분류', '약호', '출판물명', '주문수량', '최근배송일자'];

        return array_merge($title, $data);

    }
}
