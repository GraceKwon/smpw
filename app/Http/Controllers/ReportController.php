<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ReportService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;

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
    public function exportReports(Request $request) 
    {
        $fileName = $request->MetroID ? getMetroName() . '_' : '' ;
        $fileName .= $request->CircuitID ? getCircuitName() . '_' : '' ;
        $fileName .= $request->ServiceZoneID ? getServiceZoneName() . '_' : '' ;
        $fileName .= $request->ServiceDate . '_';
        $fileName .= '봉사보고.xlsx';

        return Excel::download(new ReportsExport, $fileName);
    }

    public function requests(Request $request)
    {
        if($request->CreateDate){
            $request->CreateDate = explode('~', preg_replace('/\s+/', '', $request->CreateDate));
            $request->StartDate = $request->CreateDate[0];
            $request->EndDate = $request->CreateDate[1];
        }
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();


        return view('report.requests', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'VisitRequestList' => $this->ReportService->getVisitRequestList(),
        ]);
    }

    public function formRequests(Request $request)
    {
        $res = DB::select( 'uspGetStandingServiceVisitRequestDetail ?', [
                $request->VisitRequestID
            ]);

        if( empty($res) ) abort(404); /* empty( [] ) === true */

        return view('report.formRequests', [
            'VisitRequest' => reset($res)
        ]);
    }

    public function putRequests(Request $request)
    {
        $request->validate([
            'InsteresterName' => 'required',
            'Gender' => 'required',
            'Country' => 'required',
            'ZipCode' => 'required',
            'Sido' => 'required',
            'Sigungu' => 'required',
            'AddressMain' => 'required',
            'AddressDetail' => 'required',
            'Mobile' => 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
            'Email' => 'nullable|email',
            'RequestWeekday' => 'required',
            'RequestTime' => 'required',
        ]);

        $res = DB::select('uspSetStandingServiceVisitRequestUpdate ?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
            $request->VisitRequestID,
            $request->InsteresterName,
            $request->Gender,
            $request->Country,
            $request->Sido,
            $request->Sigungu,
            $request->AddressMain,
            $request->AddressDetail,
            $request->ZipCode,
            $request->Mobile,
            $request->Email,
            $request->RequestWeekday,
            $request->RequestTime,
            $request->Contents,
        ]);
        // dd($res);
        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '수정 실패하였습니다.']);
        else
            return back()->with(['success' => '수정 되었습니다.']);
    }

    public function confirmRequests(Request $request)
    {
        $res = DB::select('uspSetStandingServiceVisitRequestAdminConfirm ?,?', [
            $request->VisitRequestID,
            session('auth.AdminID'),
        ]);
        // dd($res);
        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '실패하였습니다.']);
        else
            return back()->with(['success' => '성공하였습니다']);
    }

    public function receipRequests(Request $request)
    {
        $res = DB::select('uspSetStandingServiceVisitRequestBranchRedeip ?', [
            $request->VisitRequestID,
        ]);
        // dd($res);
        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '실패하였습니다.']);
        else
            return back()->with(['success' => '성공하였습니다']);
    }

    public function experiences(Request $request)
    {
        if($request->CreateDate){
            $request->CreateDate = explode('~', preg_replace('/\s+/', '', $request->CreateDate));
            $request->StartDate = $request->CreateDate[0];
            $request->EndDate = $request->CreateDate[1];
        }
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        return view('report.experiences', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ExperienceList' => $this->ReportService->getExperienceList(),
        ]);
    }

    public function formExperiences()
    {
        $CongregationList = $this->CommonService->getCongregationList();

        return view('report.formExperiences', [
            'CongregationList' => $CongregationList,
        ]);
    }
}
