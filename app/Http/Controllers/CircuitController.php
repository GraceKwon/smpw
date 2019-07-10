<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function __construct()
    {
      
    }

    public function view_zones(Request $request)
    {
        return view( 'circuit.zones', [
            // 'breadcrumb' => $breadcrumb,
        ]);
    }
}
