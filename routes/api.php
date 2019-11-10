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
    Route::post('modalPublisherSet', function(ActService $ActService){
        return $ActService->setPublisherServicePlanInsert();
    });
    Route::post('modalPublisherSet/search', function(ActService $ActService){
        return $ActService->modalPublisherSearch();
    });
    Route::post('modalPublisherCancel', function(ActService $ActService){
        return $ActService->setPublisherServicePlanCancel();
    });
    Route::post('modalTimeCancel', function(ActService $ActService){
        return $ActService->setServiceTimeCancel();
    });
    Route::post('modalZoneCancel', function(ActService $ActService){
        return $ActService->setServiceZoneCancel();
    });
    Route::post('modalTodayCancel', function(ActService $ActService){
        return $ActService->setServiceTodayCancel();
    });