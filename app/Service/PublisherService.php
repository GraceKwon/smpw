<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use Illuminate\Support\Facades\App;

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
        if (App::isLocale('ko')) {
            $ServiceYoil = request()->ServiceYoil ?? '월';
            
        } else {
            switch (request()->ServiceYoil) {
                case 'Monday':
                    $ServiceYoil = '월';
                    break;
                case 'Tuesday':
                    $ServiceYoil = '화';
                    break;
                case 'Wednesday':
                    $ServiceYoil = '수';
                    break;
                case 'Thursday':
                    $ServiceYoil = '목';
                    break;
                case 'Friday':
                    $ServiceYoil = '금';
                    break;
                case 'Saturday':
                    $ServiceYoil = '토';
                    break;                     
                case 'Sunday':
                    $ServiceYoil = '일';
                    break;
                default:
                    $ServiceYoil = '월';
                    break;
            }
        }
        // $ServiceYoil = request()->ServiceYoil ?? '월';
        $ArrayServiceTimePublisher = $this->getArrayServiceTimePublisher();
        $ServiceZoneList = $this->CommonService->getServiceZoneList();
        $res = DB::select( 'uspGetStandingServiceTimeList ?,?', [
                session('auth.CircuitID') ?? request()->CircuitID,
                $ServiceYoil,
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
                            $ArrayServiceTimePublisher[$ServiceZone->ServiceZoneID][$ServiceYoil][$key] ??
                            __('msg.UNS'),
                    ];

                if( empty( $array[$key][$ServiceZone->ServiceZoneID] ) )
                    $array[$key][$ServiceZone->ServiceZoneID] = [];

            }
        }
        return $array ?? null;
    }

    public function getServiceYoilSetTimeCount()
    {
        $res =  DB::table('ServiceTimeSets')
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
        foreach($res as $item){
            $array[$item->ServiceYoil] = $item->Count;
        }

        foreach( ['월', '화', '수', '목', '금', '토', '일'] as $weekday ){
            if( isset($array[$weekday]) ) $sort_array[$weekday] = $array[$weekday];
        }

        return $sort_array ?? [];

    }

}
