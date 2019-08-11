<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function view_stocks()
    {
        return view('product.stocks');
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
