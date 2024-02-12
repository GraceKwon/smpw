<?php

namespace App\Http\Controllers;

use App\Exports\NoneUseStatisticPublisherExport;
use App\Service\CommonService;
use App\Service\PushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NonPublisherController extends Controller
{
    protected string $locale;
    public function __construct(CommonService $CommonService, PushService $PushService)
    {
        $this->CommonService = $CommonService;
        $this->PushService = $PushService;
        $this->middleware('admin_auth');
        $this->locale = App::getLocale();
    }

    public function nonPublishers(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();

        $paginate = 30;
        $page = $request->input('page', '1');
        $parameter = [
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            $request->month ?? 1,
        ];
        $data = DB::select('uspGetStandingPublisheAbsentList ?,?,?,?,?',
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingPublisheAbsentListCnt ?,?,?', $parameter);

        $NonPublisherList = setPaginator($paginate, $page, $data, $count);

        return view( 'NonPublisher.nonpublisher', [
            'PublisherList' => $NonPublisherList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
            'locale' => $this->locale,
        ]);
    }

    public function exportNonPublishers(Request $request)
    {
        $month = $request->Month ?? 1;
        $fileName = $month.'개월미참여자통계.xlsx';

        return Excel::download(new NoneUseStatisticPublisherExport, $fileName);
    }
}
