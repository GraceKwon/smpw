<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ReportService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
use App\Exports\ExperienceExport;

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
        $fileName = (session('auth.MetroID') ?? $request->MetroID) ? getMetroName() . '_' : '' ;
        $fileName .= (session('auth.CircuitID') ?? $request->CircuitID) ? getCircuitName() . '_' : '' ;
        $fileName .= $request->ServiceZoneID ? getServiceZoneName() . '_' : '' ;
        $fileName .= $request->ServiceDate . '_';
        $fileName .= '봉사보고.xlsx';

        return Excel::download(new ReportsExport, $fileName);
    }

    public function requests(Request $request)
    {
        explodeRequestCreateDate();
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
        $locate = App::getLocale();
        if ($locate === 'ko') {
            $regex = 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/';
        } else {
            $regex = 'required';
        }

        $request->validate([
            'InsteresterName' => 'required',
            'Gender' => 'required',
            'Country' => 'required',
            'ZipCode' => 'required',
            'Sido' => 'required',
            'Sigungu' => 'required',
            'AddressMain' => 'required',
            'AddressDetail' => 'required',
            'Mobile' => $regex,
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
        explodeRequestCreateDate();
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        return view('report.experiences', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ExperienceList' => $this->ReportService->getExperienceList(),
        ]);
    }

    public function formExperiences(Request $request)
    {
        if( $request->ExperienceID !== '0' ) {
            $res = DB::select( 'uspGetStandingServiceExperienceDetail ?', [
                $request->ExperienceID
            ]);
            $Experience = reset($res); /* reset( [] ) === false */
            if( empty($Experience) ) abort(404); /* empty( false ) === true */
        }

        return view('report.formExperiences', [
            'Experience' => $Experience ?? null
        ]);


    }

    public function putExperiences(Request $request)
    {
        $request->validate([
            'PublisherID' => 'required',
            'Contents' => 'required',
        ]);
        if($request->ExperienceID === '0')
            $res = DB::select('uspSetStandingServiceExperienceInsert ?,?,?', [
                session('auth.AdminID'),
                $request->PublisherID,
                $request->Contents,
                ]);
        else
            $res = DB::select('uspSetStandingServiceExperienceUpdate ?,?,?', [
                $request->ExperienceID,
                $request->PublisherID,
                $request->Contents,
                ]);

        if(getAffectedRows($res) === 0)
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        else
            if($request->ExperienceID === '0')
                return redirect('/experiences');
            else
                return back()->with(['success' => '저장 성공하였습니다.']);
    }

    public function deleteExperiences(Request $request)
    {
        $res = DB::select('uspSetStandingServiceExperienceDelete ?,?', [
                $request->ExperienceID,
                0,
            ]);

        if( getAffectedRows($res) === 0 )
            return back()->withErrors(['fail' => '삭제 실패하였습니다.']);
        else
            return redirect('/experiences');

    }

    public function circuitConfirmExperiences(Request $request)
    {
        $res = DB::select('uspSetStandingServiceExperienceCircuitConfirm ?,?', [
            $request->ExperienceID,
            1,
        ]);
        // dd($res);
        if(getAffectedRows($res) === 0)
            return back()->withErrors(['fail' => '실패하였습니다.']);
        else
            return back()->with(['success' => '성공하였습니다']);
    }

    public function branchConfirmExperiences(Request $request)
    {
        $res = DB::select('uspSetStandingServiceExperienceBranchConfirm ?,?', [
            $request->ExperienceID,
            1,
        ]);
        // dd($res);
        if(getAffectedRows($res) === 0)
            return back()->withErrors(['fail' => '실패하였습니다.']);
        else
            return back()->with(['success' => '성공하였습니다']);
    }
    public function exportExperiences(Request $request)
    {
        if( $request->ExperienceID !== '0' ) {
            $res = DB::select( 'uspGetStandingServiceExperienceDetail ?', [
                $request->ExperienceID
            ]);
            $Experience = reset($res); /* reset( [] ) === false */
            if( empty($Experience) ) abort(404); /* empty( false ) === true */
        }

        $fileName = $Experience->MetroName . '_' ;
        $fileName .= $Experience->CircuitName . '_' ;
        $fileName .= $Experience->PublisherName . '_' ;
        $fileName .= '경험담보고.xlsx';

        return Excel::download(new ExperienceExport($Experience), $fileName);
    }
}
