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

    public function serviceZones(Request $request)
    {
        $request->CirCode = '';
        // return view( 'circuit.zones', [
        //     'ZoneList' => DB::table('TB_Zone')->paginate(10),
        // ]);
        return view( 'circuit.serviceZones', [
            'ServiceZoneList' => DB::select('uspGetStandingServiceZoneList'),
        ]);
    }

    public function formServiceZones(Request $request)
    {
        $ServiceZoneID = $request->ServiceZoneID;
       
        return view( 'circuit.formServiceZones', [
            'ServiceZoneID' => $ServiceZoneID,
        ]);
    }

    public function putServiceZones(Request $request)
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
