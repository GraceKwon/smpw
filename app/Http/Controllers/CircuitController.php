<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function __construct()
    {
      
    }

    public function view_territory()
    {
        $array = [];
        foreach (config('user_auth') as $key => $main) {
            echo $main['title'] . '<br>';
            $headKey = $key;
            $array[$key]['title'] = $main['title'];
            foreach ($main['sub'] as $key => $sub) {
                if( array_search(5 ,$sub['auth']) !== false){
                    $array[$headKey][] = [$key => $sub['name']];
                    echo ' - ' . $sub['name']. '<br>';
                };
                // dd($value);
            }
            // dd($value);
        }
        dd($array);
        // dd(config('user_auth'));
        // return view('circuit.zones');
    }
}
