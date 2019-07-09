<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function __construct()
    {
      
    }

    public function view_zones()
    {
        return view('circuit.zones');
    }
}
