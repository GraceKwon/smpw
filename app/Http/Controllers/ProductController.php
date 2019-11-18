<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ProductService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductOrderExport;
use App\Exports\ProductStockExport;

class ProductController extends Controller
{
    public function __construct(CommonService $CommonService, ProductService $ProductService)
    {
        $this->CommonService = $CommonService;
        $this->ProductService = $ProductService;
        $this->middleware('admin_auth');
    }

    public function stocks(Request $request)
    {
        explodeRequestCreateDate();
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        return view('product.stocks', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ProductList' => $this->ProductService->getProductList(),
            'ProductStockList' => $this->ProductService->getProductStockList(),
        ]);
    }

    public function exportStocks(Request $request) 
    {
        $fileName = (session('auth.MetroID') ?? $request->MetroID) ? getMetroName() . '_' : '' ;
        $fileName .= (session('auth.CircuitID') ?? $request->CircuitID) ? getCircuitName() . '_' : '' ;
        $fileName .= $request->ProductID ? getProductName() . '_' : '' ;
        $fileName .= '출판물재고.xlsx';

        return Excel::download(new ProductStockExport, $fileName);
    }

    public function modifyStocks(Request $request)
    {
        return view('product.modifyStocks', [
            'ProductStockList' => $this->ProductService->getProductStockList(),
        ]);
    }

    public function orders()
    {
        explodeRequestCreateDate();
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        return view('product.orders', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ProductList' => $this->ProductService->getProductList(),
            'ProductOrderList' => $this->ProductService->getProductOrderList(),
        ]);
    }

    public function formOrders(Request $request)
    {
        // dd('d');
        if($request->ProductOrderID !== '0'){
            $res = DB::select( 'uspGetStandingProductOrderDeatil ?', [
                    $request->ProductOrderID
                ]);
            $ProductOrder = reset($res);
            if( empty($ProductOrder) ) abort(404); /* empty( [] ) === true */
        }

        return view('product.formOrders', [
            'ProductList' => $this->ProductService->getProductList(),
            'ProductOrder' => $ProductOrder ?? null
        ]);
    }

    public function putOrders(Request $request)
    {
        DB::transaction(function() use ($request)
        {
            foreach ($request->ProductID as $index => $ProductID) {
                // dd(session('auth.AdminID'));
                // dd($ProductID);
                
                DB::select('uspSetStandingProductOrderInsert ?,?,?,?', [
                    session('auth.CircuitID'),
                    session('auth.AdminID'),
                    $ProductID,
                    $request->OrderCnt[$index],
                ]);
            }
        });
            
        return redirect('/orders');
     
    }

    public function exportOrders(Request $request) 
    {
        $fileName = (session('auth.MetroID') ?? $request->MetroID) ? getMetroName() . '_' : '' ;
        $fileName .= (session('auth.CircuitID') ?? $request->CircuitID) ? getCircuitName() . '_' : '' ;
        $fileName .= $request->ProductID ? getProductAlias() . '_' : '' ;
        $fileName .= '출판물주문.xlsx';

        return Excel::download(new ProductOrderExport, $fileName);
    }

    public function view_detail_orders()
    {
        return view('product.detail_orders');
    }
}
