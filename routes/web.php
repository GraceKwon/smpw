<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//공통
Route::get('/phpinfo', function(){
    phpinfo();
});
//메인
Route::get('/', 'DashBoardController@viewDashboard');

//어드민
    //로그인
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@tryLogin');
    Route::get('/logOut', 'LoginController@logOut');
    //비밀번호 설정&초기화
    Route::get('/SetPwd', 'LoginController@SetPwd');
    Route::put('/SetPwd', 'LoginController@putSetPwd');
    Route::get('/ResetPwd', 'LoginController@ResetPwd');
    Route::put('/ResetPwd', 'LoginController@putResetPwd');

//에러페이지
Route::view('/errors/auth', 'errors.auth');

//순회구관리
    //구역관리
    Route::get('ServiceZones', 'CircuitController@ServiceZones');
    Route::get('ServiceZones/{ServiceZoneID}', 'CircuitController@formServiceZones')
        ->where('ServiceZoneID', '[0-9]+');
    Route::put('ServiceZones/{ServiceZoneID}', 'CircuitController@putServiceZones')
        ->where('ServiceZoneID', '[0-9]+');
    Route::delete('ServiceZones/{ServiceZoneID}', 'CircuitController@deleteServiceZones')
        ->where('ServiceZoneID', '[0-9]+');
    //사용자관리
    Route::get('admins', 'CircuitController@admins');
    Route::get('admins/{AdminID}', 'CircuitController@formAdmins')
        ->where('AdminID', '[0-9]+');
    Route::put('admins/{AdminID}', 'CircuitController@putAdmins')
        ->where('AdminID', '[0-9]+');
    Route::delete('admins/{AdminID}', 'CircuitController@deleteAdmins')
        ->where('AdminID', '[0-9]+');
    Route::post('admins/{AdminID}', 'CircuitController@resetPwdAdmins')
        ->where('AdminID', '[0-9]+');
    //보관장소관리
    Route::get('KeepZones', 'CircuitController@KeepZones');
    Route::get('KeepZones/{KeepZoneID}', 'CircuitController@formKeepZones')
        ->where('KeepZoneID', '[0-9]+');
    Route::put('KeepZones/{KeepZoneID}', 'CircuitController@putKeepZones')
        ->where('KeepZoneID', '[0-9]+');

//봉사자관리
    //봉사자관리
    Route::get('publishers', 'PublisherController@publishers');
    Route::get('publishers/{PublisherID}', 'PublisherController@formPublishers')
        ->where('PublisherID', '[0-9]+');
    Route::put('publishers/{PublisherID}', 'PublisherController@putPublishers')
        ->where('PublisherID', '[0-9]+');
    Route::patch('publishers/{PublisherID}', 'PublisherController@putServiceTimePublieher')
        ->where('PublisherID', '[0-9]+');
    Route::delete('publishers/{PublisherID}', 'PublisherController@deletePublishers')
        ->where('PublisherID', '[0-9]+');
    Route::post('publishers/{PublisherID}', 'PublisherController@resetPwdPublishers')
        ->where('PublisherID', '[0-9]+');

//봉사일정관리
    //봉사일정관리
    // Route::get('acts', function(){
    //     return redirect('/acts?SetMonth=' . date('Y-m'));
    // });
    Route::get('acts', 'ActController@acts');
    Route::get('acts/{CircuitID}', 'ActController@detailActs')
        ->where('CircuitID', '[0-9]+');
    //봉사일정생성
    Route::get('create', 'ActController@create');
    Route::get('fcm', 'ActController@fcm');
    Route::get('fcmtopic', 'ActController@fcmtopic');
    

//봉사보고관리
    //봉사보고관리
    Route::get('reports', 'ReportController@reports');
    Route::get('reports/detail', 'ReportController@detailReports');
    Route::get('reports/export', 'ReportController@exportReports');

    //방문요청관리
    Route::get('requests', 'ReportController@requests');
    Route::get('requests/{VisitRequestID}', 'ReportController@formRequests')
        ->where('VisitRequestID', '[0-9]+');
    Route::put('requests/{VisitRequestID}', 'ReportController@putRequests')
        ->where('VisitRequestID', '[0-9]+');
    Route::patch('requests/{VisitRequestID}', 'ReportController@confirmRequests')
        ->where('VisitRequestID', '[0-9]+');
    Route::post('requests/{VisitRequestID}', 'ReportController@receipRequests')
        ->where('VisitRequestID', '[0-9]+');
    //경험담관리
    Route::get('experiences', 'ReportController@experiences');
    Route::get('experiences/{ExperienceID}', 'ReportController@formExperiences')
        ->where('ExperienceID', '[0-9]+');
    Route::get('experiences/{ExperienceID}/export', 'ReportController@exportExperiences')
        ->where('ExperienceID', '[0-9]+');
    Route::put('experiences/{ExperienceID}', 'ReportController@putExperiences')
        ->where('ExperienceID', '[0-9]+');
    Route::patch('experiences/{ExperienceID}', 'ReportController@circuitConfirmExperiences')
        ->where('ExperienceID', '[0-9]+');
    Route::post('experiences/{ExperienceID}', 'ReportController@branchConfirmExperiences')
        ->where('ExperienceID', '[0-9]+');
    Route::delete('experiences/{ExperienceID}', 'ReportController@deleteExperiences')
        ->where('ExperienceID', '[0-9]+');

//출판물관리
    //출판물재고관리
    Route::get('stocks', 'ProductController@stocks');
    Route::get('stocks/export', 'ProductController@exportStocks');
    Route::get('stocks/{CircuitID}', 'ProductController@formStocks')
        ->where('CircuitID', '[0-9]+');
    Route::put('stocks/{CircuitID}', 'ProductController@putStocks')
        ->where('CircuitID', '[0-9]+');
    //출판물신청관리
    Route::get('orders', 'ProductController@orders');
    Route::post('orders', 'ProductController@putMutipleInvoiceCode');
    Route::get('orders/export', 'ProductController@exportOrders');
    Route::get('orders/{ProductOrderID}', 'ProductController@formOrders');
    Route::put('orders/{ProductOrderID}', 'ProductController@putOrders');
    Route::delete('orders/{ProductOrderID}', 'ProductController@deleteOrders');
        
//봉사기록통계
    //봉사자통계
    Route::get('STTST_publishers', 'StatisticController@view_STTST_publishers');
    //봉사보고통계
    Route::get('STTST_reports', 'StatisticController@view_STTST_reports');
    //출판물배부통계
    Route::get('STTST_products', 'StatisticController@view_STTST_products');

//게시판관리
    //공지사항
    Route::get('notices', 'BoardController@notices');
    Route::get('notices/{id}', 'BoardController@detailNotices');
    Route::get('notices/{id}/form', 'BoardController@formNotices');
    Route::post('notices/{id}/form', 'BoardController@putNotices');
    Route::get('notices/{id}/file/{fid}', 'BoardController@fileDownload');


//메세지함
    //받은메세지함
    Route::get('inbox', 'LatterController@inbox');
    Route::get('inbox/{id}', 'LatterController@detailInbox');
    Route::get('inbox/{id}/file/{fid}', 'LatterController@fileDownload');
    //보낸메세지함
    Route::get('sent', 'LatterController@sent');
    Route::get('sent/{id}', 'LatterController@formSent');
    Route::post('sent/{id}/form', 'LatterController@putSent');
    
    //푸시메세지발송
    Route::get('pushes', 'LatterController@pushes');
    
/*
비동기
*/
use App\Service\CommonService;
use App\Service\ReportService;
use App\Service\ActService;
use App\Service\ProductService;
use App\Service\PushService;
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
Route::get('getReceiveAdminList', function(CommonService $CommonService){
    return $CommonService->getReceiveAdminList(request()->name);
});


//봉사일정관리
    //봉사일정관리
    Route::post('modalPublisherSet', function(ActService $ActService){
        return $ActService->setPublisherServicePlanInsert();
    });
    Route::post('modalPublisherSet/search', function(ActService $ActService){
        return $ActService->modalPublisherSearch();
    });
    Route::post('modalPublisherCancel', 'ActController@modalPublisherCancel');
    Route::post('modalTimeCancel', 'ActController@modalTimeCancel');
    Route::post('modalZoneCancel', 'ActController@modalZoneCancel');
    Route::post('modalDayCancel', 'ActController@modalDayCancel');
    Route::post('modalPush', 'ActController@modalPush');
    Route::post('modalPushAllZones', 'ActController@modalPushAllZones');
//봉사보고관리
    //봉사보고관리
    Route::post('modalProductDetail', function(ReportService $ReportService){
        return $ReportService->getReportProductDetailList();
    });
    Route::post('modalVisitRequestDetail', function(ReportService $ReportService){
        return $ReportService->getReportVisitRequestDetailList();
    });
    Route::post('modalMemoDetail', function(ReportService $ReportService){
        return $ReportService->getReportMemoDetailList();
    });

//출판물관리
    //출판물신청
    Route::post('getProductStock', function(ProductService $ProductService){
        return $ProductService->getProductStock();
    });