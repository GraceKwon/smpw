<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use Exception;

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
        // $week = ['일', '월', '화', '수', '목', '금', '토'];

        $res = DB::select( 'uspGetStandingServiceTimeList ?,?', [
            session('auth.CircuitID') ?? request()->CircuitID,
            request()->ServiceYoil ?? getWeekName(  date('w', strtotime( request()->ServiceDate ) ) ),
        ]);

        foreach ($res as $object) {
            $arrayServiceTime[] = $object->ServiceTime;
            $ServiceTimeList[$object->ServiceZoneID]['ZoneName'] = $object->ZoneName;
            $ServiceTimeList[$object->ServiceZoneID][$object->ServiceTime] = $object->ServiceTimeID;
        }
        // dd($ServiceTimeList);


        return [
            'min' => isset($arrayServiceTime) ? min($arrayServiceTime) : null,
            'max' => isset($arrayServiceTime) ? max($arrayServiceTime) : null,
            'ServiceTimeList' => $ServiceTimeList ?? [],
        ];
    }

    /**
     * 봉사타임지정관리 24.01.01 원종원
     * @return array
     */
    public function getArrayServiceTimeSetList(): array
    {
        // $week = ['일', '월', '화', '수', '목', '금', '토'];
        $res = DB::select( 'uspGetStandingDailyServiceTimeSetList ?,?,?', [
            session('auth.MetroID') ?? request()->MetroID,
            session('auth.CircuitID') ?? request()->CircuitID,
            request()->ServiceYoil ?? getWeekName(  date('w', strtotime( request()->ServiceDate ) ) ),
        ]);
        // return $res;
        foreach($res as $object){
            // ServiceZoneID
            $ServicePlanDetail[$object->ServiceZoneID][$object->ServiceTime][] = $object;
        }
        // dd($ServicePlanDetail);
        return $ServicePlanDetail ?? [];
    }

    public function getDailyServicePlanDetail()
    {
        $res = DB::select('uspGetStandingDailyServicePlanDetail ?,?', [
            session('auth.CircuitID') ?? request()->CircuitID,
            request()->ServiceDate,
        ]);

        foreach($res as $object){

            $ServicePlanDetail[$object->ServiceZoneID][$object->ServiceTime][] = $object;

        }
        // dd($ServicePlanDetail);

        return $ServicePlanDetail ?? [];
    }

    public function setPublisherServicePlanInsert()
    {
        if( $this->checkServicePlanPublisherCnt() >= session('auth.PublisherNumber')) return 'full';

        if( request()->LeaderYn === '1' )
            if($this->checkServicePlanHasLeader()) return 'Already Leader';

        DB::statement('uspSetPublisherServicePlanInsert ?,?,?,?,?,?', [
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
                1,
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

    public function checkServicePlanHasLeader()
    {
        return DB::table('ServiceActs')
            ->where([
                ['ServiceZoneID' ,request()->ServiceZoneID],
                ['ServiceTimeID' ,request()->ServiceTimeID],
                ['ServiceDate' ,request()->ServiceDate],
                ['LeaderYn' , 1],
                ['WaitingYn' , 0],
            ])
            ->whereNull('CancelDate')
            ->exists();
    }

    public function checkServicePlanPublisherCnt()
    {
        return (int)DB::table('ServiceActs')
            ->where([
                ['ServiceZoneID' ,request()->ServiceZoneID],
                ['ServiceTimeID' ,request()->ServiceTimeID],
                ['ServiceDate' ,request()->ServiceDate],
                // ['LeaderYn' , 1],
                ['WaitingYn' , 0],
            ])
            ->whereNull('CancelDate')
            ->count();
    }

    public function setPublisherServicePlanCancel()
    {
        DB::statement('uspSetStandingDailyServiceTimePublisherCancel ?,?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->PublisherID,
            request()->CancelTypeID,
            request()->ServiceDate,
            ]);
        return true;
    }

    public function setServiceTimeCancel()
    {
        DB::statement('uspSetStandingDailyServiceTimeCancel ?,?,?,?', [
            request()->ServiceZoneID,
            request()->ServiceTimeID,
            request()->CancelTypeID,
            request()->ServiceDate,
        ]);

        return true;
    }

    public function setServiceZoneCancel()
    {
        DB::statement('uspSetStandingDailyServiceZoneCancel ?,?,?', [
            request()->ServiceZoneID,
            request()->CancelTypeID,
            request()->ServiceDate,
        ]);
        return true;
    }

    public function setServiceDayCancel()
    {
        $ServiceZoneList = $this->CommonService->getServiceZoneList();

        DB::transaction(function() use ($ServiceZoneList)
        {
            foreach ($ServiceZoneList as $ServiceZone) {

                DB::statement('uspSetStandingDailyServiceZoneCancel ?,?,?', [
                    $ServiceZone->ServiceZoneID,
                    request()->CancelTypeID,
                    request()->ServiceDate,
                ]);
            }
        });
        return true;

    }

}
