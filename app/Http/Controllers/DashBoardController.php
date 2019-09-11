<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function viewDashboard()
    {
        return view('dashboard');
    }
}
