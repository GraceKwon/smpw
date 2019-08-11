<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function view_notices()
    {
        return view('board.notices');
    }

    public function view_detail_notices()
    {
        return view('board.detail_notices');
    }

    public function view_form_notices()
    {
        return view('board.form_notices');
    }
}
