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
        $parameter = [
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            NULL
        ];
        
        $Notices = DB::select('uspGetStandingNoticeList ?,?,?,?,?', 
            array_merge( [30, 1], $parameter ));

        array_splice($Notices, 5);

        // dd($Notices);

        return view('dashboard', [
            'Notices' => $Notices
        ]);
    }
}
