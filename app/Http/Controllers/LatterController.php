<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatterController extends Controller
{
    public function view_inbox()
    {
        return view('latter.inbox');
    }

    public function view_detail_inbox()
    {
        return view('latter.detail_inbox');
    }

    public function view_sent()
    {
        return view('latter.sent');
    }

    public function view_form_sent()
    {
        return view('latter.form_sent');
    }

    public function view_pushes()
    {
        return view('latter.pushes');
    }
}
