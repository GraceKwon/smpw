<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class CommonService
{
    public function __construct()
    {
    }

    public function getMetroList()
    {
        return DB::select('uspGetStandingSearchMetroList');
    }

    public function getCircuitList()
    {
        return DB::select('uspGetStandingSearchCircuitList ?', 
            [ ( session('auth.MetroID') ?? request()->MetroID ) ]);
    }

    public function getCongregationList()
    {
        return  DB::select('uspGetStandingSearchCongregationList ?', 
            [ ( session('auth.CircuitID') ?? request()->CircuitID ) ]);
    }

    // For서울지역 조정장로 봉사자등록 대응
    public function getMetroCongregationList()
    {
        $arrCircuitIDs = [];
        $CircuitIDs = DB::table('Circuits')
            ->select('CircuitID')
            ->where('MetroID', session('auth.MetroID'))
            ->get();
        
        foreach($CircuitIDs as $CircuitID) {
            $arrCircuitIDs[] .= $CircuitID->CircuitID;
        }
        return DB::table('Congregations')->whereIn('CircuitID', $arrCircuitIDs)->get();
    }
    // For서울지역 조정장로 봉사자등록 대응
    
    public function getServiceZoneList()
    {
        return  DB::select('uspGetStandingServiceZoneList ?', 
            [ ( session('auth.CircuitID') ?? request()->CircuitID ) ]);
    }

    public function getAdminRoleList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['AdminRoleID', null]);
    }

    public function getServantTypeList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['ServantTypeID', null]);
    }

    public function getPioneerTypeList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['PioneerTypeID', null]);
    }

    public function getEndTypeList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['EndTypeID', null]);
    }

    public function getCancelTypeList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['CancelTypeID', null]);
    }

    public function getReceiveGroupList($view)
    {
        /* 
        AdminRoleID 1 관리자
        AdminRoleID 2 지부사무실
        AdminRoleID 3 순회감독자
        AdminRoleID 5 조정장로
        AdminRoleID 4 순회구보조자


        ReceiveGroupID 41 순회감독자
        ReceiveGroupID 42 조정장로
        ReceiveGroupID 50 순회구보조자
        ReceiveGroupID 43 봉사자전체
      
        */
        if (session('auth.AdminRoleID') == 1) $ReceiveGroupID = [41, 42, 50, 43];
        if (session('auth.AdminRoleID') == 2) $ReceiveGroupID = [41, 42, 50, 43];
        if ($view === 'form') {
            if (session('auth.AdminRoleID') == 3) $ReceiveGroupID = [42, 50, 43];
            if (session('auth.AdminRoleID') == 5) $ReceiveGroupID = [50, 43];
            if (session('auth.AdminRoleID') == 4) $ReceiveGroupID = [43];
        }
        if ($view === 'list') {
            if (session('auth.AdminRoleID') == 3) $ReceiveGroupID = [41, 42, 50, 43];
            if (session('auth.AdminRoleID') == 5) $ReceiveGroupID = [42, 50, 43];
            if (session('auth.AdminRoleID') == 4) $ReceiveGroupID = [50, 43];
        }
    
        return DB::table('ItemCodes')
            ->where('Separate', 'ReceiveGroupID')
            ->whereIn('ID', $ReceiveGroupID)
            ->orderBy('OrderNum', 'ASC')
            ->get();
        // return  DB::select('uspGetStandingItemCodeList ?, ?', ['ReceiveGroupID', null]);
    }

    public function getReceiveAdminList($request)
    {
        return DB::table('Admins')
            ->select('AdminID', 'AdminName')
            ->when(session('auth.MetroID'), function ($query) {
                return $query->where('MetroID', session('auth.MetroID'));
            })
            ->when(session('auth.CircuitID'), function ($query) {
                return $query->where('CircuitID', session('auth.CircuitID'));
            })
            ->where([
                ['AdminName', 'LIKE', '%'.$request.'%'],
                ['UseYn', '=', 1],
            ])
            ->orWhere(function ($query) use ($request) {
                $query->where('AdminRoleID', '=', 2)
                    ->where('UseYn', 1)
                    ->where('AdminName', 'LIKE', '%'.$request.'%');
            })
            ->orderBy('AdminName', 'ASC')
            ->get();
    }

}
