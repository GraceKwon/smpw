<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function __construct()
    {
      
    }

    public function view_zones(Request $request)
    {
        
        return view( 'circuit.zones', [
            'json' => DB::table('notices')->where([
                ])
                ->paginate(1),
        ]);
    }

    public function view_form_zones(Request $request)
    {
        $ServiceZoneID = $request->ServiceZoneID;
       
        return view( 'circuit.form_zone', [
            'ServiceZoneID' => $ServiceZoneID,
        ]);
    }
}
