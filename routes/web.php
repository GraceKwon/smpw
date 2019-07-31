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
Route::get('/', function(){
    return redirect('/zones');
});
Route::get('/login', 'LoginController@try_login');

Route::get('/errors/auth', function(){
    return view('errors.auth');
});

//순회구관리
Route::get('zones', 'CircuitController@view_zones')->middleware('admin_auth');
Route::get('zones/{ServiceZoneID}', 'CircuitController@view_form_zones')
    ->where('ServiceZoneID', '[0-9]+')
    ->middleware('admin_auth');
Route::post('zones/{ServiceZoneID}', 'CircuitController@put_form_zones')
    ->where('ServiceZoneID', '[0-9]+')
    ->middleware('admin_auth');

