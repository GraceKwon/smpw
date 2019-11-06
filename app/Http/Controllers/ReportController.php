<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CommonService;
use App\Service\ReportService;

class ReportController extends Controller
{
    public function __construct(CommonService $CommonService, ReportService $ReportService)
    {
        $this->CommonService = $CommonService;
        $this->ReportService = $ReportService;
        $this->middleware('admin_auth');
    }

    public function reports(Request $request)
    {
        if($request->SetMonth === null) $request->SetMonth = date('Y-m');

        if($request->MetroID === null 
            && session('auth.MetroID') == null){
            $request->MetroID = $this->CommonService->getMetroList()[0]->MetroID ?? '';
        }

        if($request->CircuitID === null 
            && session('auth.CircuitID') === null){
            $request->CircuitID = $this->CommonService->getCircuitList()[0]->CircuitID ?? '';
        }

        return view('report.reports', [
            'MetroList' => $this->CommonService->getMetroList(),
            'CircuitList' => $this->CommonService->getCircuitList(),
            'dailyServiceReportCnt' => $this->ReportService->getDailyServiceReportCnt(),
            'lastDay' => date('t', strtotime($request->SetMonth)),
            'firstWeek' => date('w', strtotime($request->SetMonth)),
        ]);
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
            'ReportList' => $this->ReportService->getDailyServiceReportList(),
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
