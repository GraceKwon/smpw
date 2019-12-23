<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;

class PublisherService
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function getArrayServiceTimePublisher()
    {
        $res = DB::select( 'uspGetStandingServiceTimePublisher ?', [
            request()->PublisherID,
        ]);
        foreach ($res as $object) {
            $array[$object->ServiceZoneID][$object->ServiceYoil][$object->ServiceTime] = $object->ServiceSetType;
        }
        return isset($array) ? $array : null;
    }

    public function getServiceTimeList()
    {
        $ServiceYoil = request()->ServiceYoil ?? '월';
        $ArrayServiceTimePublisher = $this->getArrayServiceTimePublisher();
        $ServiceZoneList = $this->CommonService->getServiceZoneList();
        $res = DB::select( 'uspGetStandingServiceTimeList ?,?', [ 
                session('auth.CircuitID') ?? request()->CircuitID,
                request()->ServiceYoil ?? '월',
            ]);
        
        foreach ((array) $res as $key => $ServiceTime) {
            $sort[$key] = $ServiceTime->ServiceTime;
        }
        if($res) array_multisort($sort, SORT_ASC, $res);

        foreach ( $res as $ServiceTime) {
            $key = $ServiceTime->ServiceTime;

            foreach ( $ServiceZoneList as $ServiceZone) {
                if($ServiceZone->ServiceZoneID === $ServiceTime->ServiceZoneID)

                    $array[$key][$ServiceZone->ServiceZoneID] = [
                        'ServiceZoneID' => $ServiceZone->ServiceZoneID,
                        'PublisherCnt' => $ServiceTime->PublisherCnt,
                        'LeaderCnt' => $ServiceTime->LeaderCnt,
                        'ServiceTimeID' => $ServiceTime->ServiceTimeID,
                        'ServiceSetType' => 
                            isset( $ArrayServiceTimePublisher[$ServiceZone->ServiceZoneID][$ServiceYoil][$key] )
                            ? $ArrayServiceTimePublisher[$ServiceZone->ServiceZoneID][$ServiceYoil][$key]
                            : '미지정',
                    ];
                

                if( empty( $array[$key][$ServiceZone->ServiceZoneID] ) )
                    $array[$key][$ServiceZone->ServiceZoneID] = [];
 
            }
        }
        return $array ?? null;
    }

    public function getServiceYoilSetTimeCount()
    {
        return DB::table('ServiceTimeSets')
            ->select(
                'ServiceTimes.ServiceYoil',
                DB::raw('COUNT(*) AS Count')
            )
            ->where([
                ['ServiceTimeSets.PublisherID', request()->PublisherID],
            ])
            ->leftJoin('ServiceTimes', 'ServiceTimeSets.ServiceTimeID', 'ServiceTimes.ServiceTimeID')
            ->groupBy('ServiceTimes.ServiceYoil')
            ->get();
        
    }

}
