<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;

class ActService
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function getDailyServicePlanCnt()
    {
        $res = DB::select('uspGetStandingDailyServicePlanCnt ?,?', [
            session('auth.CircuitID') ?? request()->CircuitID,
            date('Y-m-01', strtotime( request()->SetMonth )),
        ]);
        foreach($res as $object){
            $array[date('j', strtotime($object->ServiceDate))] = $object;
        }
        return $array ?? [];
    }

    public function getArrayServiceTime()
    {
        $res = DB::select( 'uspGetStandingServiceTimeList ?,?', [ 
            session('auth.CircuitID') ?? request()->CircuitID,
            request()->ServiceYoil ?? '월',
        ]);
        
        foreach ($res as $object) {
            $arrayServiceTime[] = $object->ServiceTime;
            $arrayServiceTimeID[$object->ServiceZoneID][$object->ServiceTime] = $object->ServiceTimeID;
        }
        // dd($arrayServiceTimeID);

        
        return [
            'min' => isset($arrayServiceTime) ? min($arrayServiceTime) : null,
            'max' => isset($arrayServiceTime) ? max($arrayServiceTime) : null,
            'arrayServiceTimeID' => $arrayServiceTimeID ?? null,
        ];
    }

    public function getDailyServicePlanDetail()
    {
        $res = DB::select('uspGetStandingDailyServicePlanDetail ?,?', [
            session('auth.CircuitID') ?? request()->CircuitID,
            request()->ServiceDate,
        ]);

        foreach($res as $object){
            //모든 ServiceTime을 arrayServiceTime에 담는다
            $dailyServicePlanDetail[$object->ZoneName]['ServiceZoneID'] = $object->ServiceZoneID;
            $dailyServicePlanDetail[$object->ZoneName][$object->ServiceTime][] = $object;
        }
    
        // dd($dailyServicePlanDetail);

        
        return $dailyServicePlanDetail ?? [];
    }

    public function setPublisherServicePlanInsert()
    {
 
        DB::select('uspSetPublisherServicePlanInsert ?,?,?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->PublisherID,
            request()->LeaderYn,
            request()->WaitingYn,
            request()->ServiceDate,
        ]);
    }

    public function modalPublisherSearch()
    {
        if ( request()->PublisherName ) {

            $paginate = 5;  
            $page = request()->input('page', '1');
            $parameter = [
                null,
                session('auth.CircuitID') ?? request()->CircuitID,
                null,
                request()->PublisherName,
                null,
                null,
                0,
            ];

            $data = DB::select('uspGetStandingPublisherList ?,?,?,?,?,?,?,?,?', 
                array_merge( [$paginate, $page], $parameter ));
            $count = DB::select('uspGetStandingPublisherListCnt ?,?,?,?,?,?,?', $parameter);
            $count = getTotalCnt($count);
            $lastPage = ceil($count / $paginate);
  
            return [
                'data' => $data,
                'lastPage' => $lastPage,
            ];
        } 
        else
            return ['data' => []];
    
    }

    public function setPublisherServicePlanCancel()
    {
 
        DB::select('uspSetStandingDailyServiceTimePublisherCancel ?,?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->PublisherID,
            request()->CancelTypeID,
            request()->ServiceDate,
        ]);
    }

    public function setServiceTimeCancel()
    {
        DB::select('uspSetStandingDailyServiceTimeCancel ?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->CancelTypeID,
            request()->ServiceDate,
        ]);
    }

    public function setServiceZoneCancel()
    {
        DB::select('uspSetStandingDailyServiceZoneCancel ?,?,?', [
            request()->ServiceZoneID,
            request()->CancelTypeID,
            request()->ServiceDate,
        ]);
    }

    public function setServiceTodayCancel()
    {
        $ServiceZoneList = $this->CommonService->getServiceZoneList();

        DB::transaction(function() use ($ServiceZoneList)
        {
            foreach ($ServiceZoneList as $ServiceZone) {

                DB::select('uspSetStandingDailyServiceZoneCancel ?,?,?', [
                    $ServiceZone->ServiceZoneID,
                    request()->CancelTypeID,
                    request()->ServiceDate,
                ]);
            }
        });
       
    }

}
