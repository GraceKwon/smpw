<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function view_reports()
    {
        return view('report.reports');
    }

    public function view_detail_reports()
    {
        return view('report.detail_reports');
    }

    public function view_requests()
    {
        return view('report.requests');
    }

    public function view_detail_requests()
    {
        return view('report.datail_requests');
    }

    public function view_form_requests()
    {
        return view('report.form_requests');
    }

    public function view_experiences()
    {
        return view('report.experiences');
    }

    public function view_detail_experiences()
    {
        return view('report.datail_experiences');
    }

    public function view_form_experiences()
    {
        return view('report.form_experiences');
    }
}
