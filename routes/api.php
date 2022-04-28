<?php
//
//use Illuminate\Support\Facades\Route;
//
///*
//|--------------------------------------------------------------------------
//| API Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register API routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| is assigned the "api" middleware group. Enjoy building your API!
//|
//*/
//
//
//Route::group([
//    'prefix' => 'auth',
//], function () {
//    Route::get('visitor','AuthController@visitor');
//    Route::post('login','AuthController@login')->name('login');
//    //Route::post('social_login','AuthController@social_login');
//
//    Route::post('social_login','AuthController@social_login');
//
//    Route::post('signup','AuthController@register');
//    Route::post('check_reset_code','AuthController@check_reset_code');
//    Route::post('forget_password','AuthController@forget_password');
//    Route::post('reset_password','AuthController@reset_password');
//    Route::get('resend_verify', 'AuthController@resend_verify');
//    Route::post('verify', 'AuthController@verify');
//    Route::group([
//        'middleware' => 'auth:api'
//    ], function() {
//        Route::get('me','AuthController@show');
//        Route::get('points','AuthController@points');
//        Route::post('refresh','AuthController@refresh');
//        Route::post('update','AuthController@update');
//        Route::post('change_password','AuthController@change_password');
//        Route::post('logout','AuthController@logout');
//    });
//});
//Route::group([
//    'middleware' => 'auth:api',
//    'prefix' => 'address',
//], function() {
//    Route::get('/', 'AddressController@index');
//    Route::post('show', 'AddressController@show');
//    Route::post('store', 'AddressController@store');
//    Route::post('delete', 'AddressController@delete');
//});
//Route::get('install','HomeController@install');
//
//Route::group([
//    'prefix' => 'tickets',
//    'middleware' => 'auth:api'
//], function() {
//        Route::get('/','TicketController@index');
//        Route::get('show','TicketController@show');
//        Route::post('store','TicketController@store');
//        Route::post('response','TicketController@response');
//});
//Route::group([
//    'prefix' => 'home',
//], function() {
//    Route::get('/', 'HomeController@index');
//});
//Route::group([
//    'prefix' => 'product',
//], function() {
//    Route::get('/', 'ProductController@index');
//    Route::get('brands', 'ProductController@brands');
//    Route::get('show', 'ProductController@show');
//});
//Route::group(['middleware' => 'auth:api', 'prefix' => 'product' ],
//    function(){
//        Route::get('favorites', 'ProductController@favorites');
//        Route::post('toggle_favorite', 'ProductController@toggle_favorite');
//        Route::post('review', 'ProductController@review');
//});
//Route::group([
//    'middleware' => 'auth:api',
//    'prefix' => 'notifications',
//], function() {
//    Route::get('/', 'NotificationController@index');
//    Route::post('send', 'NotificationController@send');
//    Route::post('read', 'NotificationController@read');
//    Route::post('read/all', 'NotificationController@read_all');
//});
//Route::group([
//    'prefix' => 'orders',
//    'middleware' => 'auth:api'
//], function() {
//        Route::get('/','OrderController@index');
//        Route::post('show','OrderController@show');
//        Route::post('store','OrderController@store');
//        Route::post('update','OrderController@update');
//        Route::post('delete','OrderController@delete');
//});
//Route::group([
//    'prefix' => 'cart',
//    'middleware' => 'auth:api'
//], function() {
//    Route::get('/','CartController@index');
//    Route::post('store','CartController@store');
//    Route::post('update','CartController@update');
//    Route::post('delete','CartController@delete');
//});
//Route::group([
//    'prefix' => 'points',
//    'middleware' => 'auth:api'
//], function() {
//    Route::get('show','PointsController@show');
//    Route::post('store','PointsController@store');
//    Route::post('update','PointsController@update');
//});
