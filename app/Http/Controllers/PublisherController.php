<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\PublisherService;

class PublisherController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
        $this->middleware('admin_auth');
    }

    public function publishers(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
// dd($CongregationList);
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            $request->CongregationID,
            $request->PublisherName,
            $request->Gender,
            $request->ServantTypeID,
            $request->EndYn,
        ];
        $data = DB::select('uspGetStandingPublisherList ?,?,?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingPublisherListCnt ?,?,?,?,?,?,?', $parameter);

        $PublisherList = setPaginator($paginate, $page, $data, $count);
        // dd($PublisherList);
        return view( 'publisher.publishers', [
            'PublisherList' => $PublisherList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
        ]);
    }

    public function formPublishers(Request $request, PublisherService $PublisherService)
    {
        if( $request->PublisherID !== '0' ) {
            $res = DB::select( 'uspGetStandingPublisherDetail ?', [
                $request->PublisherID
                ]);
                $Publisher = reset($res); /* reset( [] ) === false */
                if( empty($Publisher) ) abort(404); /* empty( false ) === true */
                
                $request->CircuitID = $Publisher->CircuitID;
            }
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
        $PioneerTypeList = $this->CommonService->getPioneerTypeList();
        $EndTypeIDList = $this->CommonService->getEndTypeList();
        
        $ServiceZoneList = $this->CommonService->getServiceZoneList();
        $ServiceTimeList = $PublisherService->getServiceTimeList();
        return view('publisher.formPublisher', [
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
            'PioneerTypeList' => $PioneerTypeList,
            'EndTypeIDList' => $EndTypeIDList,
            'Publisher' => $Publisher ?? null,
            'ServiceZoneList' => $ServiceZoneList,
            'ServiceTimeList' => $ServiceTimeList,
        ]);
    }

    public function putPublishers(Request $request)
    {
        $request->validate([
            'PublisherName' => 'required',
            'CongregationID' => 'required',
            'Gender' => 'required',
            'Mobile' => 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
            'PioneerTypeID' => 'required',
            'ServantTypeID' => 'required',
            'SupportYn' => 'required',
            'EndDate' => $request->StopYn === '1' ? 'required' : '' . '|date',
            'EndTypeID' => $request->StopYn === '1' ? 'required' : '',
        ]);
        if($request->PublisherID === '0')
            $res = DB::select('uspSetStandingPublisherInsert ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    'AAAA0003',//$request->Account,
                    $request->PublisherName,
                    '11112222',//$request->UserPassword,
                    $request->CongregationID,
                    $request->Gender,
                    $request->Mobile,
                    40,//$request->MobileOsKindID,
                    null,//$request->PhotoFilePath,
                    $request->PioneerTypeID,
                    $request->ServantTypeID,
                    1,//$request->UseYn,
                    $request->SupportYn,
                    $request->Memo,
                    $request->EndDate,
                    $request->EndTypeID,
                ]);
        else
            $res = DB::select('uspSetStandingPublisherUpdate ?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    $request->PublisherID,
                    $request->PublisherName,
                    $request->CongregationID,
                    $request->Gender,
                    $request->Mobile,
                    40,//$request->MobileOsKindID,
                    null,//$request->PhotoFilePath,
                    $request->PioneerTypeID,
                    $request->ServantTypeID,
                    1,//$request->UseYn,
                    $request->SupportYn,
                    $request->Memo,
                    $request->EndDate,
                    $request->EndTypeID,
                ]);

        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.'])->withInput();
        else
            return redirect('/publishers');

    }

    public function deletePublishers(Request $request)
    {
        $res = DB::select('uspSetStandingPublisherDelete ?,?', [
                $request->PublisherID,
                0,
            ]);

        if( getAffectedRows($res) === 0 ) 
            return back()->withErrors(['fail' => '삭제 실패하였습니다.']);
        else
            return redirect('/publishers');
        
    }

    public function resetPwdPublishers(Request $request)
    {
        $res = DB::table('Publishers')
            ->where('PublisherID', $request->PublisherID)
            ->update([
                'UserPassword' => DB::Raw("HASHBYTES('SHA2_512', '11112222')"),
                'TempPassYn' => 1,
            ]);
        // if( getAffectedRows($res) === 0 ) 
        if( $res === 0 ) 
            return back()->withErrors(['fail' => '비밀번호 초기화를 실패하였습니다.']);
        else
            return back()->with(['success' => '비밀번호 초기화를 성공하였습니다.']);

        
    }

    public function putServiceTimePublieher(Request $request)
    {
        $request->validate([
            'SetStartDate' => 'required|date',
        ]);
        $ServiceSetType = $request->ServiceSetType;
        $PublisherID = $request->PublisherID;
        $SetStartDate = $request->SetStartDate;
        // dd($ServiceSetType);
        DB::transaction(function() use ($ServiceSetType, $PublisherID, $SetStartDate)
        {
            foreach ($ServiceSetType as $ServiceTimeID => $ServiceSetType) {
                DB::select('uspSetStandingServiceTimePublieherDelete ?,?', [
                    $PublisherID,
                    $ServiceTimeID,
                    ]);

                if($ServiceSetType !== '미지정')
                    DB::select('uspSetStandingServiceTimePublieherInsert ?,?,?,?,?', [
                        $PublisherID,
                        $ServiceTimeID,
                        ($ServiceSetType ==='인도자') ? 1 : 0,
                        ($ServiceSetType ==='대기') ? 1 : 0,
                        $SetStartDate,
                    ]);
            }
        });

        return back();
        
    }



}
