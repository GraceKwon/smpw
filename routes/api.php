<?php
use App\Service\CommonService;
use App\Service\ReportService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//공통
Route::get('/getMetroList', function(CommonService $CommonService){
    return $CommonService->getMetroList();
});
Route::get('/getCircuitList', function(CommonService $CommonService){
    return $CommonService->getCircuitList();
});
Route::get('/getCongregationList', function(CommonService $CommonService){
    return $CommonService->getCongregationList();
});

//봉사보고관리
    //봉사보고관리
    Route::get('reports', function(ReportService $ReportService){
        return $ReportService->getDailyServiceReportCnt();
    });