<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;

class CircuitController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
        $this->middleware('CheckCircuitID', ['only' => ['putServiceZones']]);
    }

    public function serviceZones(Request $request)
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
            'ZoneName' => 'required|max:10|unique:ServiceZones',
            'ZoneAlias' => 'required|max:5|unique:ServiceZones',
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
        $MetroList = DB::select('uspGetStandingSearchMetroList');
        $CircuitList = DB::select('uspGetStandingSearchCircuitList ?', [$request->input('MetroID', null)]);
        $CongregationList = DB::select('uspGetStandingSearchCongregationList ?', [$request->input('CircuitID', null)]);
        
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
            'CongregationList' => $CongregationList
        ]);
    }

    public function formAdmins(Request $request)
    {
        return view( 'circuit.formAdmins', [
       
        ]);
    }

    public function putAdmins(Request $request)
    {
        if($request->ServiceZoneID === '0')
            $res = DB::select('uspSetStandingAdminInsert ?,?,?,?,?,?,?,?', [
                    $request->Account, //Account
                    '11112222',// UserPassword
                    $request->AdminName, //AdminName
                    $request->AdminRoleID, //AdminRoleID
                    1, //TempUseYn
                    $request->Mobile, //Mobile
                ]);
        else
            $res = DB::select('uspSetStandingAdminUpdate ?,?,?,?,?,?,?,?,?', [
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

    public function keepZones(Request $request)
    {
        $request->CirCode = '';
        $parameter = [
            30, //@PageSize
            1, //@PageNumber
            1, //@MetroID
            1, //@CircuitID
            1, //@CongregationID
            1, //@AdminName
        ];
        // return view( 'circuit.zones', [
        //     'ZoneList' => DB::table('TB_Zone')->paginate(10),
        // ]);
        return view( 'circuit.serviceZones', [
            'KeepZoneList' => DB::select('uspGetStandingProductKeepZoneList ?,?,?,?,?,?', []),
        ]);
    }
}
