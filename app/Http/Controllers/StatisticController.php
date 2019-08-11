<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function view_STTST_publishers()
    {
        return view('statistic.STTST_publishers');
    }

    public function view_STTST_reports()
    {
        return view('statistic.STTST_reports');
    }

    public function view_STTST_products()
    {
        return view('statistic.STTST_products');
    }
}
