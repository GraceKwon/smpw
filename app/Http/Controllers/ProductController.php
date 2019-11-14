<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CommonService;
use App\Service\StockService;

class ProductController extends Controller
{
    public function __construct(CommonService $CommonService, StockService $StockService)
    {
        $this->CommonService = $CommonService;
        $this->StockService = $StockService;
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
            'ProductList' => $this->StockService->getProductList(),
            'ProductStockList' => $this->StockService->getProductStockList(),
        ]);
    }

    public function view_orders()
    {
        return view('product.orders');
    }

    public function view_detail_orders()
    {
        return view('product.detail_orders');
    }
}
