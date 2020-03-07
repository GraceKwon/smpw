<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StatisticPublisherExport;

class StatisticController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
        $this->middleware('admin_auth');
    }

    public function publishers(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        if($request->TypeID === '2' || $request->TypeID === '3') $CircuitList = $this->CommonService->getCircuitList();
        if($request->TypeID === '3') $CongregationList = $this->CommonService->getCongregationList();

        $request->paginate = $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->TypeID ?? '1',
            ( session('auth.MetroID') ?? $request->MetroID ),
            ( session('auth.CircuitID') ?? $request->CircuitID ),
            $request->CongregationID,
        ];
        $data = DB::select('uspGetStandingStatisticsPublisherList ?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingStatisticsPublisherListCnt ?,?,?,?', $parameter);
        $StatisticListList = setPaginator($paginate, $page, $data, $count);
        // dd($StatisticListList);
        return view('statistic.publishers', [
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList ?? NULL,
            'CongregationList' => $CongregationList ?? NULL,
            'StatisticListList' => $StatisticListList ?? NULL
        ]);
    }

    public function exportPublishers(Request $request) 
    {
        $fileName = '봉사자통계.xlsx';
        
        return Excel::download(new StatisticPublisherExport, $fileName);
    }

    public function reports()
    {
        return view('statistic.reports', []);
    }

    public function products()
    {
        return view('statistic.products');
    }
}
