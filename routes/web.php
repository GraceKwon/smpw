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

//봉사보고관리
    //봉사보고관리
    Route::get('reports', 'ReportController@reports');
    Route::get('reports/detail', 'ReportController@detailReports');
    //방문요청관리
    Route::get('requests', 'ReportController@view_requests');
    Route::get('requests/{id}', 'ReportController@view_detail_requests');
    Route::get('requests/{id}/form', 'ReportController@view_form_requests');
    //경험담관리
    Route::get('experiences', 'ReportController@view_experiences');
    Route::get('experiences/{id}', 'ReportController@view_detail_experiences');
    Route::get('experiences/{id}/form', 'ReportController@view_form_experiences');

//출판물관리
    //출판물재고관리
    Route::get('stocks', 'ProductController@view_stocks');
    //출판물신청관리
    Route::get('orders', 'ProductController@view_orders');
    Route::get('orders/{id}', 'ProductController@view_detail_orders');
    Route::get('orders/{id}/form', 'ProductController@view_form_orders');
        
//봉사기록통계
    //봉사자통계
    Route::get('STTST_publishers', 'StatisticController@view_STTST_publishers');
    //봉사보고통계
    Route::get('STTST_reports', 'StatisticController@view_STTST_reports');
    //출판물배부통계
    Route::get('STTST_products', 'StatisticController@view_STTST_products');

//게시판관리
    //공지사항
    Route::get('notices', 'BoardController@view_notices');
    Route::get('notices/{id}', 'BoardController@view_detail_notices');
    Route::get('notices/{id}/form', 'BoardController@view_form_notices');
    Route::post('notices/{id}/form', 'BoardController@postForm');

//메세지함
    //받음메세지함
    Route::get('inbox', 'LatterController@view_inbox');
    Route::get('inbox/{id}', 'LatterController@view_detail_inbox');
    //보낸메세지함
    Route::get('sent', 'LatterController@view_sent');
    Route::get('sent/{id}', 'LatterController@view_form_sent');
    //푸시메세지발송
    Route::get('pushes', 'LatterController@view_pushes');
    
