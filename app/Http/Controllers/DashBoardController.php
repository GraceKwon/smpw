<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }
    public function viewDashboard()
    {
        return view('dashboard');
    }
}
