<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActController extends Controller
{
    public function view_acts()
    {
        return view('act.acts');
    }

    public function view_detail_acts()
    {
        return view('act.detail_acts');
    }

    public function view_create()
    {
        return view('act.create');
    }
}
