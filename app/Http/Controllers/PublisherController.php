<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function view_publishers()
    {
        return view('publisher.publishers');
    }

    public function view_form_publishers()
    {
        return view('publisher.form_publisher');
    }
}
