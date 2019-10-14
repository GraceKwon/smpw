<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActController extends Controller
{
    public function Acts()
    {
        return view('act.acts');
    }

    public function detailActs()
    {
        return view('act.detailActs');
    }

    public function create()
    {
        return view('act.create');
    }
}
