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
Route::get('/', 'DashBoardController@view_dashboard');
Route::get('/login', 'LoginController@try_login');
Route::get('/reset_pwd', 'LoginController@view_reset_pwd');
Route::get('/set_pwd', 'LoginController@view_set_pwd');

Route::view('/errors/auth', function(){
    return view('errors.auth');
});

//순회구관리
    //구역관리
    Route::get('zones', 'CircuitController@view_zones');
    Route::get('zones/{ServiceZoneID}', 'CircuitController@view_form_zones')
        ->where('ServiceZoneID', '[0-9]+');
    Route::post('zones/{ServiceZoneID}', 'CircuitController@put_form_zones')
        ->where('ServiceZoneID', '[0-9]+');
    //사용자관리
    Route::get('admins', 'CircuitController@view_admins');
    Route::get('admins/{AdminID}', 'CircuitController@view_form_admin')
        ->where('AdminID', '[0-9]+');
    Route::post('admins/{AdminID}', 'CircuitController@put_form_admins')
        ->where('AdminID', '[0-9]+');

//봉사자관리
    //봉사자관리
    Route::get('publishers', 'PublisherController@view_publishers');
    Route::get('publishers/{PublisherID}', 'PublisherController@view_form_publishers')
        ->where('PublisherID', '[0-9]+');

//봉사일정관리
    //봉사일정관리
    Route::get('acts', 'ActController@view_acts');
    Route::get('acts/{id}', 'ActController@view_detail_acts');
    //봉사일정생성
    Route::get('create', 'ActController@view_create');

//봉사보고관리
    //봉사보고관리
    Route::get('reports', 'ReportController@view_reports');
    Route::get('reports/{id}', 'ReportController@view_detail_reports');
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

//메세지함
    //받음메세지함
    Route::get('inbox', 'LatterController@view_inbox');
    Route::get('inbox/{id}', 'LatterController@view_detail_inbox');
    //보낸메세지함
    Route::get('sent', 'LatterController@view_sent');
    Route::get('sent/{id}', 'LatterController@view_form_sent');
    //푸시메세지발송
    Route::get('pushes', 'LatterController@view_pushes');
    
