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
    public function dashboard(Request $request)
    {
        $Notices = DB::select('uspGetStandingNoticeList ?,?,?,?,?,?', 
            [
                30,
                1,
                ( session('auth.MetroID') ?? $request->MetroID ),
                ( session('auth.CircuitID') ?? $request->CircuitID ),
                NULL,
                session('auth.AdminRoleID')
            ]);

        array_splice($Notices, 5);

        $StatisticsCnt = DB::select('uspGetStandingStatisticsCnt ?,?', 
            [
                session('auth.MetroID'),
                session('auth.CircuitID'),
            ]);

        $MainActCntTypeID1 = DB::select('uspGetStandingStatisticsMainActsCnt ?,?,?', 
            [
                session('auth.MetroID'),
                session('auth.CircuitID'),
                1
            ]);

        $MainActCntTypeID2 = DB::select('uspGetStandingStatisticsMainActsCnt ?,?,?', 
            [
                session('auth.MetroID'),
                session('auth.CircuitID'),
                2
            ]);
            
        $MainActCntTypeID3 = DB::select('uspGetStandingStatisticsMainActsCnt ?,?,?', 
            [
                session('auth.MetroID'),
                session('auth.CircuitID'),
                3
            ]);


        return view('dashboard', [
            'Notices' => $Notices,
            'StatisticsCnt' => reset($StatisticsCnt),
            'MainActCntTypeID1' => reset($MainActCntTypeID1),
            'MainActCntTypeID2' => reset($MainActCntTypeID2),
            'MainActCntTypeID3' => reset($MainActCntTypeID3),
        ]);
    }
}
