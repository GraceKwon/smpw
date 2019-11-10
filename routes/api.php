<?php
use App\Service\CommonService;
use App\Service\ReportService;
use App\Service\ActService;

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


//봉사일정관리
    //봉사일정관리
    Route::put('modalPublisherSet', function(ActService $ActService){
        return $ActService->setPublisherServicePlanInsert();
    });
    Route::put('modalPublisherSet/search', function(ActService $ActService){
        return $ActService->modalPublisherSearch();
    });
    Route::put('modalPublisherCancel', function(ActService $ActService){
        return $ActService->setPublisherServicePlanCancel();
    });
    Route::put('modalTimeCancel', function(ActService $ActService){
        return $ActService->setServiceTimeCancel();
    });
    Route::put('modalZoneCancel', function(ActService $ActService){
        return $ActService->setServiceZoneCancel();
    });
    Route::put('modalTodayCancel', function(ActService $ActService){
        return $ActService->setServiceTodayCancel();
    });