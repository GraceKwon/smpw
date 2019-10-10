<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Service\CommonService;

class CircuitController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
        $this->middleware('admin_auth');
        $this->middleware('CheckCircuitID', ['only' => ['putServiceZones']]);
    }

    public function serviceZones()
    {
        $ServiceZoneList = DB::select('uspGetStandingServiceZoneList ?', [ 
                session('auth.CircuitID')   
            ]);
        
        return view( 'circuit.serviceZones', [
            'ServiceZoneList' => $ServiceZoneList,
        ]);
    }

    public function formServiceZones(Request $request)
    {
        if( $request->ServiceZoneID !== '0' ) {

            $res = DB::select( 'uspGetStandingServiceZoneDetail ?', [ $request->ServiceZoneID ] );
            $ServiceZone = reset($res); /* reset( [] ) === false */
            if( empty($ServiceZone) || $ServiceZone->UseYn === 0 ) abort(404); /* empty( false ) === true */

        }

        return view( 'circuit.formServiceZones', [
                'ServiceZone' => isset($ServiceZone) ? $ServiceZone : null, 
            ]);
    }

    public function putServiceZones(Request $request)
    {
        $request->validate([
            'ZoneName' => 'required|max:10',
            'ZoneAlias' => 'required|max:5',
            'Latitude' => 'required',
            'Longitude' => 'required',
            'ZoneAddress' => 'required',
            'OrderNum' => 'required',
        ]);
        if($request->ServiceZoneID === '0')
            $res = DB::select('uspSetStandingServiceZoneInsert ?,?,?,?,?,?,?,?', [
                    $request->ZoneName,
                    $request->ZoneAlias,
                    $request->Latitude,
                    $request->Longitude,
                    $request->ZoneAddress,
                    $request->OrderNum,
                    session('auth.AdminID'),
                    session('auth.CircuitID')
                ]);
        else
            $res = DB::select('uspSetStandingServiceZoneUpdate ?,?,?,?,?,?,?,?,?', [
                    $request->ServiceZoneID,
                    $request->ZoneName,
                    $request->ZoneAlias,
                    $request->Latitude,
                    $request->Longitude,
                    $request->ZoneAddress,
                    $request->OrderNum,
                    session('auth.AdminID'),
                    session('auth.CircuitID')
                ]);
        

        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        else
            return redirect('/ServiceZones');
        
    }

    public function deleteServiceZones(Request $request)
    {
        $res = DB::select('uspSetStandingServiceZoneDelete ?', [
                $request->ServiceZoneID,
            ]);

        if( getAffectedRows($res) === 0 ) 
            return back()->withErrors(['fail' => '삭제 실패하였습니다.']);
        else
            return redirect('/ServiceZones');
        
    }

    public function admins(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $AdminRoleList = $this->CommonService->getAdminRoleList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
        
        $paginate = 30;  
        $page = $request->input('page', '1');
    
        $parameter = [
                $request->input('MetroID', null),
                $request->input('CircuitID', null),
                $request->input('CongregationID', null),
                $request->input('AdminName', null),
                $request->input('Gender', null)
            ];

        $data = DB::select('uspGetStandingAdminList ?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingAdminListCnt ?,?,?,?,?', $parameter);
        $AdminList = setPaginator($paginate, $page, $data, $count);
   
        return view( 'circuit.admins', [
            'AdminList' => $AdminList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'AdminRoleList' => $AdminRoleList,
            'ServantTypeList' => $ServantTypeList
        ]);
    }

    public function formAdmins()
    {
        $AdminRoleList = $this->CommonService->getAdminRoleList();
        $MetroList = $this->CommonService->getMetroList();
        $ServantTypeList = $this->CommonService->getServantTypeList();
   
        return view( 'circuit.formAdmins', [
            'AdminRoleList' => $AdminRoleList,
            'MetroList' => $MetroList,
            'ServantTypeList' => $ServantTypeList,
        ]);
    }

    public function putAdmins(Request $request)
    {
        $request->validate([
            'AdminName' => [
                'required',
                'min:2',
                'max:10',
                Rule::unique('Admins')->ignore($request->AdminID, 'AdminID')->where('UseYn', 1),
            ],
            'AdminRoleID' => 'required',
            'MetroID' => 'required',
            'CircuitID' => 'required',
            'CongregationID' => 'required',
            'ServantTypeID' => 'required',
            'Mobile' => 'required|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
        ]);
   

        // if($request->AdminID === '0')
        //     $res = DB::select('uspSetStandingAdminInsert ?,?,?,?,?,?,?,?', [
        //             $request->Account, //Account
        //             '11112222',// UserPassword
        //             $request->AdminName, //AdminName
        //             $request->AdminRoleID, //AdminRoleID
        //             1, //TempUseYn
        //             $request->Mobile, //Mobile
        //         ]);
        // else
        //     $res = DB::select('uspSetStandingAdminUpdate ?,?,?,?,?,?,?,?,?', [
        //             $request->ServiceZoneID,
        //             $request->ZoneName,
        //             $request->ZoneAlias,
        //             $request->Latitude,
        //             $request->Longitude,
        //             $request->ZoneAddress,
        //             $request->OrderNum,
        //             session('auth.AdminID'),
        //             session('auth.CircuitID')
        //         ]);
        

        // if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        // else
            // return redirect('/admins');
        
    }

    public function deleteAdmins(Request $request)
    {
        $res = DB::select('uspSetStandingAdminDelete ? ?', [
                $request->AdminID,
                0
            ]);

        if( getAffectedRows($res) === 0 ) 
            return back()->withErrors(['fail' => '삭제 실패하였습니다.']);
        else
            return redirect('/admins');
        
    }

    public function keepZones(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        // $ServantTypeList = $this->CommonService->getServantTypeList();
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->input('MetroID', null),
            $request->input('CircuitID', null),
            $request->input('CongregationID', null),
            $request->input('AdminName', null),
        ];
        $data = DB::select('uspGetStandingProductKeepZoneList ?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingProductKeepZoneListCnt ?,?,?,?', $parameter);

        $KeepZoneList = setPaginator($paginate, $page, $data, $count);
  
        return view( 'circuit.keepZones', [
            'KeepZoneList' => $KeepZoneList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
        ]);
    }

    public function formKeepZones(Request $request)
    {
        // if( $request->KeepZoneID !== '0' ) {

        //     $res = DB::select( 'uspGetStandingKeepZoneDetail ?', [ $request->KeepZoneID ] );
        //     $KeepZone = reset($res); /* reset( [] ) === false */
        //     if( empty($KeepZone) || $KeepZone->UseYn === 0 ) abort(404); /* empty( false ) === true */

        // }

        return view( 'circuit.formKeepZones', [
                'KeepZone' => isset($KeepZone) ? $KeepZone : null, 
            ]);
    }

    public function putKeepZones(Request $request)
    {
        $request->validate([
            'ZipCode' => 'required',
            'ZoneAddress' => 'required'
        ]);

        if($request->KeepZoneID === '0')
            $res = DB::select('uspSetStandingProductKeepZoneInsert ?,?,?', [
                    session('auth.AdminID'),
                    $request->ZipCode,
                    $request->ZoneAddress . $request->ZoneAddressDetail
                ]);
        else
            $res = DB::select('uspSetStandingProductKeepZoneUpdate ?,?,?', [
                    $request->KeepZoneID,
                    $request->ZipCode,
                    $request->ZoneAddress . $request->ZoneAddressDetail
                ]);
        

        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        else
            return redirect('/KeepZones');
        
    }
}
