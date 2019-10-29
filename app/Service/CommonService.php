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

}
