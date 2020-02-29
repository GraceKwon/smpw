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

    public function getReceiveGroupList()
    {
        $IDs = [41, 42, 43];
        if (session('auth.AdminRoleID') > 3) $IDs = [42, 43];
        return DB::table('ItemCodes')
            ->where('Separate', 'ReceiveGroupID')
            ->whereIn('ID', $IDs)
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
            ->where('AdminName', 'LIKE', '%'.$request.'%')
            ->orWhere(function ($query) use ($request) {
                $query->where('AdminRoleID', '=', 2)
                    ->where('AdminName', 'LIKE', '%'.$request.'%');
            })
            ->orderBy('AdminRoleID', 'ASC')
            ->get();
    }

}
