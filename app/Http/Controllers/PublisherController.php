<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;

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

        return view( 'publisher.publishers', [
            'PublisherList' => $PublisherList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
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
            'TempPassYn' => 'required',
            'SupportYn' => 'required',
            'EndDate' => 'date',
            'EndTypeID' => 'numeric',
        ]);
        if($request->PublisherID === '0')
            $res = DB::select('uspSetStandingPublisherInsert ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    'AAA001',//$request->Account,
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
            $res = DB::select('uspSetStandingPublisherUpdate ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                    $request->PublisherID,
                    '11112222',//$request->UserPassword,
                    $request->TempPassYn,
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

    public function formPublishers(Request $request)
    {
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
        $PioneerTypeList = $this->CommonService->getPioneerTypeList();
        $EndTypeIDList = $this->CommonService->getEndTypeList();
        $ServiceZoneList = $this->CommonService->getServiceZoneList();
        $ArrayServiceTimeID = DB::table('ServiceTimes')
            ->where('ServiceYoil', '월')
            ->get();
        foreach ($ArrayServiceTimeID as $key => $value) {
            $res[$value->ServiceZoneID][$value->ServiceTime] = $value->ServiceTimeID;
        }
        // dd($res);
        if( $request->PublisherID !== '0' ) {
            $res = DB::select( 'uspGetStandingPublisherDetail ?', [
                    $request->PublisherID
                ]);
            // $Publisher = DB::table('Publishers')->select('*')->where('PublisherID' , $request->PublisherID)->first();
            // dd($res);
            $Publisher = reset($res); /* reset( [] ) === false */
            if( empty($Publisher) ) abort(404); /* empty( false ) === true */

        }
        $ServiceTimeList = DB::select( 'uspGetStandingServiceTimeList ?,?', [ 
                session('auth.CircuitID'),
                '월',
                // $request->ServiceYoil,
            ] );
        foreach ((array) $ServiceTimeList as $key => $value) {
            $sort[$key] = $value->ServiceTime;
        }
        array_multisort($sort, SORT_ASC, $ServiceTimeList);

        foreach ( $ServiceTimeList as $key => $ServiceTime) {
            $index = $ServiceTime->ServiceTime;

            foreach ( $ServiceZoneList as $key => $ServiceZone) {
                // if($key === array_key_first($ServiceZoneList)) $array[$index]['time'] = $ServiceTime->ServiceTime;
                if($ServiceZone->ServiceZoneID === $ServiceTime->ServiceZoneID){
                    $array[$index][$ServiceZone->ServiceZoneID] = [
                        'ServiceZoneID' => $ServiceZone->ServiceZoneID,
                        'PublisherCnt' => $ServiceTime->PublisherCnt,
                        'ServiceTimeID' => $res[$ServiceZone->ServiceZoneID][$index],
                    ];
                }

                if(empty($array[$index][$ServiceZone->ServiceZoneID]))
                    $array[$index][$ServiceZone->ServiceZoneID] = [];
 
                
            }
        }
        $ServiceTimeList = $array;
        // dd($ServiceTimeList);
    
        return view('publisher.formPublisher', [
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
            'PioneerTypeList' => $PioneerTypeList,
            'EndTypeIDList' => $EndTypeIDList,
            'Publisher' => isset($Publisher) ? $Publisher : null,
            'ServiceTimeList' => $ServiceTimeList,
            'ServiceZoneList' => $ServiceZoneList,
        ]);
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
}
