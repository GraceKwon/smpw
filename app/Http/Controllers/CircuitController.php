<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function view_zones(Request $request)
    {
        $request->CirCode = '';
        // return view( 'circuit.zones', [
        //     'ZoneList' => DB::table('TB_Zone')->paginate(10),
        // ]);
        return view( 'circuit.zones', [
            'ZoneList' => DB::select('uspGetStandingServiceZoneList'),
        ]);
    }

    public function view_form_zones(Request $request)
    {
        $ServiceZoneID = $request->ServiceZoneID;
       
        return view( 'circuit.form_zone', [
            'ServiceZoneID' => $ServiceZoneID,
        ]);
    }

    public function put_form_zones(Request $request)
    {
        dd($request);
    }

    public function view_admins(Request $request)
    {
        return view( 'circuit.admins', [
       
        ]);
    }

    public function view_form_admin(Request $request)
    {
        return view( 'circuit.form_admin', [
       
        ]);
    }
}
