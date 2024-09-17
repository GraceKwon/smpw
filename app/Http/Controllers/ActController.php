<?php

namespace App\Http\Controllers;

use App\Rules\AfterToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use App\Service\ActService;
use App\Service\PushService;
use App\Service\PushNewService;

class ActController extends Controller
{
    protected string $locale;
    public function __construct(CommonService $CommonService, ActService $ActService, PushService $PushService,
                                PushNewService $PushNewService)
    {
        $this->CommonService = $CommonService;
        $this->ActService = $ActService;
        $this->PushService = $PushService;
        $this->PushNewService = $PushNewService;
        $this->locale = App::getLocale();
        $this->middleware('admin_auth')
            ->except(['modalPublisherCancel',
                'modalTimeCancel',
                'modalZoneCancel',
                'modalDayCancel',
                'modalPushTime',
                'modalPush',
                'modalPushAllZones',
                ]);
    }

    public function Acts(Request $request)
    {
        if($request->SetMonth === null) $request->SetMonth = date('Y-m');

        if($request->MetroID === null
            && session('auth.MetroID') == null){
            $request->MetroID = $this->CommonService->getMetroList()[0]->MetroID ?? '';
        }

        if($request->CircuitID === null
            && session('auth.CircuitID') === null){
            $request->CircuitID = $this->CommonService->getCircuitList()[0]->CircuitID ?? '';
        }

        return view('act.acts', [
            'MetroList' => $this->CommonService->getMetroList(),
            'CircuitList' => $this->CommonService->getCircuitList(),
            'dailyServicePlanCnt' => $this->ActService->getDailyServicePlanCnt(),
            'lastDay' => date('t', strtotime($request->SetMonth)),
            'firstWeek' => date('w', strtotime($request->SetMonth)),
            'locale' => $this->locale,
        ]);
    }

    // 봉사타임지정관리 24.01.01 원종원
    public function actsT(Request $request)
    {
        // if($request->SetMonth === null) $request->SetMonth = date('Y-m');

        if($request->MetroID === null
            && session('auth.MetroID') == null){
            $request->MetroID = $this->CommonService->getMetroList()[0]->MetroID ?? '';
        }

        if($request->CircuitID === null
            && session('auth.CircuitID') === null){
            $request->CircuitID = $this->CommonService->getCircuitList()[0]->CircuitID ?? '';
        }

        if($request->ServiceDate === null) $request->ServiceDate = date('Y-m-d');

        $date = \DateTime::createFromFormat('Y-m-d', $request->ServiceDate);
        $dayOfWeek = $date->format('w');

        $arrayServiceTime = $this->ActService->getArrayServiceTime();

        return view('act.actsT', [
            'MetroList' => $this->CommonService->getMetroList(),
            'CircuitList' => $this->CommonService->getCircuitList(),
            'days' => ['일','월','화','수','목','금','토'],
            'yoil' => $dayOfWeek,
            'max' => $arrayServiceTime['max'],
            'min' => $arrayServiceTime['min'],
            'ServiceTimeList' => $arrayServiceTime['ServiceTimeList'],
            'ServicePlanDetail' => $this->ActService->getArrayServiceTimeSetList(),
//             'ServicePlanDetail' => $this->ActService->getDailyServicePlanDetail(),
            'locale' => $this->locale,
        ]);
    }

    public function detailActs(Request $request)
    {
        $arrayServiceTime = $this->ActService->getArrayServiceTime();

        return view('act.detailActs', [
            'max' => $arrayServiceTime['max'],
            'min' => $arrayServiceTime['min'],
            'ServiceTimeList' => $arrayServiceTime['ServiceTimeList'],
            'ServicePlanDetail' => $this->ActService->getDailyServicePlanDetail(),
            'CancelTypeList' => $this->CommonService->getCancelTypeList(),
            'locale' => $this->locale,
        ]);
    }

    public function create()
    {
        return view('act.create');
    }

    public function putCreate(Request $request)
    {
        $request->validate([
            'ReSetStartDate' => [
                'required',
                'date',
                new AfterToday
            ],
        ]);
        DB::statement('uspSetStandingServiceActReInsert ?,?', [
            session('auth.CircuitID'),
            $request->ReSetStartDate,
        ]);
        return view('act.create');
    }

    public function modalPublisherCancel()
    {
        if($this->ActService->setPublisherServicePlanCancel()) {
            $this->PushNewService->PublisherCancel();
        }
    }

    public function modalTimeCancel()
    {
        $PublisherIDs = $this->PushService->getPublisherIDsTimeCancel();
        if($this->ActService->setServiceTimeCancel()) {
            $this->PushNewService->TimeCancel($PublisherIDs);
        }
    }

    /**
     * @return void
     */
    public function modalZoneCancel(): void
    {
        $PublisherIDs = $this->PushService->getPublisherIDsZoneCancel();
        if($this->ActService->setServiceZoneCancel()) {
            $this->PushNewService->ZoneCancel($PublisherIDs);
        }
    }

    public function modalDayCancel(): void
    {
        $PublisherIDs = $this->PushService->getPublisherIDsDayCancel();
        if($this->ActService->setServiceDayCancel()) {
            $this->PushNewService->DayCancel($PublisherIDs);
        }
    }

    public function modalPushTime()
    {
        $this->PushNewService->RequestJoinTime();
    }

    public function modalPush()
    {
        $this->PushNewService->RequestJoin();
    }

    public function modalPushAllZones()
    {
        $this->PushNewService->RequestJoinAllZones();
    }

}
