<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CommonService;

class ReportController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function reports()
    {
        return view('report.reports');
    }

    public function detailReports()
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $ServiceZoneList = $this->CommonService->getServiceZoneList();
      
        return view('report.detailReports', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ServiceZoneList' => $ServiceZoneList,
        ]);
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
