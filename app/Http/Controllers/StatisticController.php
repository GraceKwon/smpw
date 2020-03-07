<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function publishers()
    {
        return view('statistic.publishers');
    }

    public function reports()
    {
        return view('statistic.reports');
    }

    public function products()
    {
        return view('statistic.products');
    }
}
