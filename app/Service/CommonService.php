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
            [request()->input('MetroID', null)]);
    }

    public function getCongregationList()
    {
        return  DB::select('uspGetStandingSearchCongregationList ?', 
            [request()->input('CircuitID', null)]);
    }

    public function getAdminRoleList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['AdminRoleID', null]);
    }

    public function getServantTypeList()
    {
        return  DB::select('uspGetStandingItemCodeList ?, ?', ['ServantTypeID', null]);
    }

}
