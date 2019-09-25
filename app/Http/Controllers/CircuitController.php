<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CircuitController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
        $this->middleware('CheckCircuitID', ['only' => ['putServiceZones']]);
    }

    public function serviceZones(Request $request)
    {
        return view( 'circuit.serviceZones', [
            'ServiceZoneList' => DB::select('uspGetStandingServiceZoneList'),
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
        // $MetroList = DB::select('uspGetStandingSearchMetroList');
        // $CircuitList = DB::select('uspGetStandingSearchCircuitList ?', []);
        // $CongregationList = DB::select('uspGetStandingSearchCongregationList ?', []);
        $AdminList = DB::select('uspGetStandingAdminList ?,?,?,?,?,?,?', [
            3,
            1,
            null,
            null,
            null,
            null,
            null,
        ]);
        // dd($AdminList);
        return view( 'circuit.admins', [
            // 'MetroList' => $MetroList;,
            // 'CircuitList' => $CircuitList;,
            // 'CongregationList' => $CongregationList;,
            'AdminList' => $AdminList,
        ]);
    }

    public function view_form_admin(Request $request)
    {
        return view( 'circuit.form_admin', [
       
        ]);
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
