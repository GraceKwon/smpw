<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct()
    {
    }

    public function getProductStockList()
    {
        $paginate = 100;
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

    public function getProductOrderList()
    {
        $paginate = 100;
        $page = request()->input('page', 1);

        $parameter = [
                ( session('auth.MetroID') ?? request()->MetroID ),
                ( session('auth.CircuitID') ?? request()->CircuitID ),
                request()->ProductID,
                request()->StartDate,
                request()->EndDate,
            ];

        $data = DB::select('uspGetStandingProductOrderList ?,?,?,?,?,?,?',
            array_merge( [$paginate, $page], $parameter ));

        $count = DB::select('uspGetStandingProductOrderListCnt ?,?,?,?,?', $parameter);
        return setPaginator($paginate, $page, $data, $count);
    }

    public function getProductStock()
    {
        // return session('auth.CircuitID');
        return DB::select('uspGetStandingProductOrderStock ?,?', [
            ( session('auth.CircuitID') ?? request()->CircuitID ),
            request()->ProductID
        ]);

    }

    public function putProductOrderInvoice($ProductOrderID = null)
    {
        $res =  DB::select('uspSetStandingProductOrderInvoiceUpdate ?,?', [
            $ProductOrderID ?? request()->ProductOrderID,
            request()->InvoiceCode,
        ]);

        if( getAffectedRows($res) === 1
            && DB::table('ProductStocks')->where('ProductOrderID', $ProductOrderID ?? request()->ProductOrderID)->doesntExist() )
            $res =  DB::select('uspSetStandingProductStockInsert ?', [
                $ProductOrderID ?? request()->ProductOrderID
            ]);
        return $res;

    }


}
