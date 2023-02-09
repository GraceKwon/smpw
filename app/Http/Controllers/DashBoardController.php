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
    //    장기 미참여
        // $lastService = DB::table('ServiceActs')
        //     ->select('PublisherID', DB::raw('MAX(ServiceDate) as last_service_date'))
        //     ->whereNotNull('CancelDate')
        //     ->groupBy('PublisherID');
    
        // $dd = DB::table('Publishers')
        //         ->select('Publishers.*','last_service.last_service_date')
        //             ->leftJoin('Congregations', 'Publishers.CongregationID', '=', 'Congregations.CongregationID')
        //             ->leftJoin('Circuits', 'Congregations.CircuitID', '=', 'Circuits.CircuitID')
        //             ->leftJoin('Metros', 'Circuits.MetroID', '=', 'Metros.MetroID')

        //            ->leftJoinSub($lastService, 'last_service', function ($join) {
        //                $join->on('Publishers.PublisherID', '=', 'last_service.PublisherID');
        //            })
        //            ->where([
        //             ['UseYn', '=', 1],
        //             ['Circuits.CircuitID', '=', session('auth.CircuitID')],
        //             ['Metros.MetroID', '=', session('auth.MetroID')],
        //             // ['last_service_date', '=', null],
        //             ['last_service_date', '<', '2022-06-30'],
        //             ])
        //             ->orWhere([
        //                 ['UseYn', '=', 1],
        //                 ['Circuits.CircuitID', '=', session('auth.CircuitID')],
        //                 ['Metros.MetroID', '=', session('auth.MetroID')],
        //                 ['last_service_date', '=', null],
        //                 // ['last_service_date', '>', '2022-06-30'],
        //                 ])
        //             ->orderBy('last_service_date', 'desc')
        //             ->get();
        // dd($dd);
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
