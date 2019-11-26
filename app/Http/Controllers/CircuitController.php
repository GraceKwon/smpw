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
        // $this->middleware('CheckCircuitID', ['only' => ['putServiceZones']]);
    }

    public function serviceZones(Request $request)
    {
        if($request->MetroID === null 
            && session('auth.MetroID') == null){
            $request->MetroID = $this->CommonService->getMetroList()[0]->MetroID ?? '';
        }

        if($request->CircuitID === null 
            && session('auth.CircuitID') === null){
            $request->CircuitID = $this->CommonService->getCircuitList()[0]->CircuitID ?? '';
        }
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        
        $ServiceZones = DB::select('uspGetStandingServiceZoneList ?', [ 
                session('auth.CircuitID') ?? $request->CircuitID
            ]);
        
        return view( 'circuit.serviceZones', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'ServiceZones' => $ServiceZones,
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
            'ZoneName' => [
                'required',
                'max:10',
                Rule::unique('ServiceZones')->ignore($request->ServiceZoneID, 'ServiceZoneID')->where('UseYn', 1),
            ],
            'ZoneAlias' => [
                'required',
                'max:5',
                Rule::unique('ServiceZones')->ignore($request->ServiceZoneID, 'ServiceZoneID')->where('UseYn', 1),
            ],
            'Latitude' => 'required',
            'Longitude' => 'required',
            'ZoneAddress' => 'required',
            'OrderNum' => [
                'required',
                Rule::unique('ServiceZones')->ignore($request->ServiceZoneID, 'ServiceZoneID')
                    ->where('UseYn', 1)
                    ->where('CircuitID', session('auth.CircuitID')),
            ]
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
            $res = DB::select('uspSetStandingServiceZoneUpdate ?,?,?,?,?,?,?,?', [
                    $request->ServiceZoneID,
                    $request->ZoneName,
                    $request->ZoneAlias,
                    $request->Latitude,
                    $request->Longitude,
                    $request->ZoneAddress,
                    $request->OrderNum,
                    session('auth.AdminID'),
                    // session('auth.CircuitID')
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
        // $CongregationList = $this->CommonService->getCongregationList();
        $AdminRoleList = $this->CommonService->getAdminRoleList();
        
        $paginate = 30;  
        $page = $request->input('page', '1');
    
        $parameter = [
                ( session('auth.MetroID') ?? $request->MetroID ),
                ( session('auth.CircuitID') ?? $request->CircuitID ),
                $request->CongregationID,
                $request->AdminRoleID,
                $request->AdminName,
                $request->Gender,
            ];

        $data = DB::select('uspGetStandingAdminList ?,?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingAdminListCnt ?,?,?,?,?,?', $parameter);
        $AdminList = setPaginator($paginate, $page, $data, $count);
   
        return view( 'circuit.admins', [
            'AdminList' => $AdminList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            // 'CongregationList' => $CongregationList,
            'AdminRoleList' => $AdminRoleList,
        ]);
    }

    public function formAdmins(Request $request)
    {
        $AdminRoleList = $this->CommonService->getAdminRoleList();
        $MetroList = $this->CommonService->getMetroList();
        
        if( $request->AdminID !== '0' ) {
            $res = DB::select( 'uspGetStandingAdminDetail ?', [
                    $request->AdminID
                ]);
                $Admin = reset($res); /* reset( [] ) === false */
                if( empty($Admin) ) abort(404); /* empty( false ) === true */
                else if($Admin->UseYn === 0) abort(404);
        }

        return view( 'circuit.formAdmins', [
            'Admin' => $Admin ?? null,
            'AdminRoleList' => $AdminRoleList,
            'MetroList' => $MetroList,
        ]);
    }

    public function putAdmins(Request $request)
    {
        $request->validate([
            'AdminName' => 'required|min:2|max:12',
            // 'AdminName' => [
            //     'required',
            //     'min:2',
            //     'max:12',
            //     Rule::unique('Admins')->ignore($request->AdminID, 'AdminID')->where('UseYn', 1),
            // ],
            'AdminRoleID' => 'required',
            // 'MetroID' => 'required',
            // 'CircuitID' => 'required',
            'Mobile' => 'nullable|regex:/^\d{2,3}-\d{3,4}-\d{4}$/',
        ]);
   
        if($request->AdminID === '0')
            $res = DB::select('uspSetStandingAdminInsert ?,?,?,?,?,?,?,?', [
                    $request->MetroID,
                    $request->CircuitID,
                    $request->CongregationID,
                    '11112222',// UserPassword
                    $request->AdminName,
                    $request->AdminRoleID,
                    1,// TempUseYn
                    $request->Mobile,
                ]);
        else
            $res = DB::select('uspSetStandingAdminUpdate ?,?,?,?,?', [
                    $request->AdminID,
                    $request->MetroID,
                    $request->CircuitID,
                    $request->CongregationID,
                    $request->AdminName,
                    $request->AdminRoleID,
                    $request->Mobile,
                ]);
        

        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        else
            return redirect('/admins');
        
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

    public function resetPwdAdmins(Request $request)
    {
        $res = DB::table('Admins')
            ->where('AdminID', $request->AdminID)
            ->update([
                'UserPassword' => DB::Raw("HASHBYTES('SHA2_512', CONVERT(nvarchar(100),'11112222') )"),
                'TempPassYn' => 1,
            ]);
        if( $res === 0 ) 
            return back()->withErrors(['fail' => '비밀번호 초기화를 실패하였습니다.']);
        else
            return back()->with(['success' => '비밀번호 초기화를 성공하였습니다.']);
        
    }

    public function keepZones(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            $request->CongregationID,
            $request->AdminName,
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
        if( $request->KeepZoneID !== '0' ) {

            $res = DB::select( 'uspGetStandingProductKeepZoneDetail ?', [ $request->KeepZoneID ] );
            $KeepZone = reset($res); /* reset( [] ) === false */
            if( empty($KeepZone) || $KeepZone->UseYn === 0 ) abort(404); /* empty( false ) === true */

        }

        return view( 'circuit.formKeepZones', [
                'KeepZone' => isset($KeepZone) ? $KeepZone : null, 
            ]);
    }

    public function putKeepZones(Request $request)
    {
        $request->validate([
            'ZipCode' => 'required',
            'ZoneAddress' => 'required',
            'ZoneAddressDetail' => 'required'
        ]);

        if($request->KeepZoneID === '0')
            $res = DB::select('uspSetStandingProductKeepZoneInsert ?,?,?,?', [
                    session('auth.AdminID'),
                    $request->ZipCode,
                    $request->ZoneAddress,
                    $request->ZoneAddressDetail,
                ]);
        else
            $res = DB::select('uspSetStandingProductKeepZoneUpdate ?,?,?,?', [
                    $request->KeepZoneID,
                    $request->ZipCode,
                    $request->ZoneAddress,
                    $request->ZoneAddressDetail,
                ]);
        

        if(getAffectedRows($res) === 0) 
            return back()->withErrors(['fail' => '저장 실패하였습니다.']);
        else
            return redirect('/KeepZones');
        
    }
}
