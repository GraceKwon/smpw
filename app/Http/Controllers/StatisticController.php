<?php

namespace App\Http\Controllers;

use App\Exports\NoneUseStatisticPublisherExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatisticPublisherExport;
use App\Exports\StatisticReportExport;
use App\Exports\StatisticProductExport;

class StatisticController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
        $this->middleware('admin_auth');
    }

    public function publishers(Request $request)
    {
        if (!$request->TypeID) $request->TypeID = '1';
        $MetroList = $this->CommonService->getMetroList();
        if ($request->TypeID === '2' || $request->TypeID === '3') $CircuitList = $this->CommonService->getCircuitList();
        if ($request->TypeID === '3') $CongregationList = $this->CommonService->getCongregationList();

        $request->paginate = $paginate = 30;
        $page = $request->input('page', '1');
        $parameter = [
            $request->TypeID,
            (session('auth.MetroID') ?? $request->MetroID),
            (session('auth.CircuitID') ?? $request->CircuitID),
            $request->CongregationID,
        ];
        $data = DB::select(
            'uspGetStandingStatisticsPublisherList ?,?,?,?,?,?',
            array_merge([$paginate, $page], $parameter)
        );
        $count = DB::select('uspGetStandingStatisticsPublisherListCnt ?,?,?,?', $parameter);
        $StatisticListList = setPaginator($paginate, $page, $data, $count);
        // dd($StatisticListList);
        return view('statistic.publishers', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList ?? NULL,
            'CongregationList' => $CongregationList ?? NULL,
            'StatisticListList' => $StatisticListList ?? NULL,
        ]);
    }

    public function exportPublishers(Request $request)
    {
        $fileName = '봉사자통계.xlsx';

        return Excel::download(new StatisticPublisherExport, $fileName);
    }

    public function exportNonPublishers(Request $request)
    {
        $fileName = '1개월미참여자통계.xlsx';

        return Excel::download(new NoneUseStatisticPublisherExport, $fileName);
    }

    public function monthlyPublishers(Request $request)
    {
        $sDate = Carbon::now()->subMonth()->format('Y-m');
        $eDate = Carbon::now()->format('Y-m');
        $month = Carbon::now()->subMonth()->format('m');

        $startDate = $sDate.'-01';
        $endDate = $eDate.'-01';

        $parameter = [
            (session('auth.CircuitID') ?? $request->CircuitID),
            $startDate,
            $endDate
        ];
        $data = DB::select(
            'uspGetStaticsReportMonthly ?,?,?',
            $parameter
        );

        return view('statistic.monthlyReport', [
            'StatisticList' => $data[0] ?? NULL,
            'month' => $month
        ]);
    }

    public function reports(Request $request)
    {
        explodeRequestCreateDate();

        if (!$request->TypeID) $request->TypeID = '1';
        $parameter = [
            $request->TypeID,
            (session('auth.MetroID') ?? $request->MetroID),
            (session('auth.CircuitID') ?? $request->CircuitID),
            $request->StartDate,
            $request->EndDate,
        ];
        $List = DB::select(
            'uspGetStandingStatisticsReportList ?,?,?,?,?',
            array_merge($parameter)
        );


        $MetroList = $this->CommonService->getMetroList();
        if ($request->TypeID === '2') $CircuitList = $this->CommonService->getCircuitList();
        return view('statistic.reports', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList ?? NULL,
            'List' => $List ?? [],
        ]);
    }

    public function exportReports(Request $request)
    {
        $fileName = '봉사보고통계.xlsx';

        return Excel::download(new StatisticReportExport, $fileName);
    }

    public function products(Request $request)
    {
        explodeRequestCreateDate();
        if (!$request->TypeID) $request->TypeID = '1';
        $parameter = [
            $request->TypeID,
            (session('auth.MetroID') ?? $request->MetroID),
            (session('auth.CircuitID') ?? $request->CircuitID),
            $request->LanguageName,
            $request->StartDate,
            $request->EndDate,
        ];
        $List = DB::select(
            'uspGetStandingStatisticsProductList ?,?,?,?,?,?',
            array_merge($parameter)
        );

        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();

        return view('statistic.products', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList ?? NULL,
            'LanguageList' => DB::select('uspGetStandingProductLanguageList'),
            'List' => $List ?? [],
        ]);
    }

    public function exportProducts(Request $request)
    {
        $fileName = (session('auth.MetroID') ?? $request->MetroID) ? getMetroName() . '_' : '' ;
        $fileName .= (session('auth.CircuitID') ?? $request->CircuitID) ? getCircuitName() . '_' : '' ;
        $fileName .= $request->Type === '1' ? '출판물상세_' : '언어상세_' ;
        $fileName .= '출판물통계.xlsx';

        return Excel::download(new StatisticProductExport, $fileName);
    }
}
