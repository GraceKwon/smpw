<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }
    public function dashboard()
    {
        $Notices = DB::select('uspGetStandingNoticeList ?,?,?,?,?', 
            [
                30,
                1,
                ( session('auth.MetroID') ?? $request->MetroID ),
                ( session('auth.CircuitID') ?? $request->CircuitID ),
                NULL
            ]);

        $StatisticsCnt = DB::select('uspGetStandingStatisticsCnt ?,?', 
            [
                session('auth.MetroID'),
                session('auth.CircuitID'),
            ]);

        ;
        array_splice($Notices, 5);

        return view('dashboard', [
            'Notices' => $Notices,
            'StatisticsCnt' => reset($StatisticsCnt),
        ]);
    }
}
