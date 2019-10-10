<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\CommonService;

class PublisherController extends Controller
{
    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
        $this->middleware('admin_auth');
    }

    public function publishers(Request $request)
    {
        $MetroList = $this->CommonService->getMetroList();
        $CircuitList = $this->CommonService->getCircuitList();
        $CongregationList = $this->CommonService->getCongregationList();
        $ServantTypeList = $this->CommonService->getServantTypeList();

        $paginate = 30;  
        $page = $request->input('page', '1');
        $parameter = [
            $request->input('MetroID', null),
            $request->input('CircuitID', null),
            $request->input('CongregationID', null),
            $request->input('PublisherName', null),
            $request->input('Gender', null),
            $request->input('ServantTypeID', null),
            $request->input('EndYn', null),
        ];
        $data = DB::select('uspGetStandingPublisherList ?,?,?,?,?,?,?,?,?', 
            array_merge( [$paginate, $page], $parameter ));
        $count = DB::select('uspGetStandingPublisherListCnt ?,?,?,?,?,?,?', $parameter);

        $PublisherList = setPaginator($paginate, $page, $data, $count);
        
        return view( 'publisher.publishers', [
            'PublisherList' => $PublisherList,
            'MetroList' => $MetroList,
            'CircuitList' => $CircuitList,
            'CongregationList' => $CongregationList,
            'ServantTypeList' => $ServantTypeList,
        ]);
    }

    public function formPublishers()
    {
        return view('publisher.formPublisher');
    }
}
