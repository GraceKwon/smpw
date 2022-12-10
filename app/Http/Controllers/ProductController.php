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

    public function formStocks(Request $request)
    {
        return view('product.formStocks', [
            'ProductStockList' => $this->ProductService->getProductStockList(),
        ]);
    }

    public function putStocks(Request $request)
    {
        // dd( $request->all() );
        foreach ($request->ProductID as $index => $ProductID) {
            if($request->Qty[$index] !== null){

                $res = DB::select('uspSetStandingProductStockDirectInsert ?,?,?', [
                    (session('auth.CircuitID') ?? $request->CircuitID),
                    $ProductID,
                    $request->Qty[$index] - $request->StockCnt[$index],
                ]);

            }
        }

        if( getAffectedRows($res) === 0 )
            return back()->withErrors(['fail' => __('msg.FAIL_CHANGE')]);
        else
            return redirect('/stocks');
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
        if( $request->ProductOrderID !== '0'
            && isset($request->InvoiceCode) ) {
            $res =  $this->ProductService->putProductOrderInvoice();

            if( getAffectedRows($res) === 0 ) {
                return back()->withErrors(['fail' => __('msg.FAIL_INVOICE_NUM') ]);
            } else {
                return back()->with(['success' => __('msg.SAVE_SUCCESS') ]);
            }
        } else if($request->ProductOrderID === '0') {
            foreach ($request->ProductID as $index => $ProductID) {
                $res = DB::select('uspSetStandingProductOrderInsert ?,?,?,?', [
                    session('auth.CircuitID'),
                    session('auth.AdminID'),
                    $ProductID,
                    $request->OrderCnt[$index],
                ]);
            }

            if( getAffectedRows($res) === 0 ) {
                return back()->withErrors(['fail' => __('msg.UR_APPLICATION_FAILED') ]);
            } else {
                return redirect('/orders');
            }
        } else {
            $res =  DB::select('uspSetStandingProductOrderUpdate ?,?,?', [
                    $request->ProductOrderID,
                    $request->ProductID[0],
                    $request->OrderCnt[0],
                ]);

            if( getAffectedRows($res) === 0 ) {
                return back()->withErrors(['fail' => __('msg.MF') ]);
            } else {
                return back()->with(['success' => __('msg.MS') ]);
            }
        }
    }

    public function putMutipleInvoiceCode(Request $request)
    {

        DB::transaction(function() use ($request)
        {
            foreach ($request->ProductOrderID as $ProductOrderID) {
                $this->ProductService->putProductOrderInvoice($ProductOrderID);
            }
        });

    }

    public function deleteOrders(Request $request)
    {
        $res = DB::select('uspSetStandingProductOrderDelete ?', [
            $request->ProductOrderID,
        ]);

        if( getAffectedRows($res) === 0 )
            return back()->withErrors(['fail' => __('msg.DF') ]);
        else
            return redirect('/orders');

    }

    public function exportOrders(Request $request)
    {
        $fileName = (session('auth.MetroID') ?? $request->MetroID) ? getMetroName() . '_' : '' ;
        $fileName .= (session('auth.CircuitID') ?? $request->CircuitID) ? getCircuitName() . '_' : '' ;
        $fileName .= $request->ProductID ? getProductAlias() . '_' : '' ;
        $fileName .= __('msg.PUB_RE_EXCEL');

        return Excel::download(new ProductOrderExport, $fileName);
    }

}
