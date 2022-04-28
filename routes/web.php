<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@application')->name('application');
Route::post('/signin', 'HomeController@login')->name('signin');
Route::post('/signup', 'HomeController@register')->name('signup');
Route::post('/logout', 'HomeController@logout')->name('logout');
Route::post('/submit_application', 'HomeController@submit_application')->name('submit_application');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/about', 'HomeController@about');
Route::get('/terms', 'HomeController@terms');
Route::get('user/verify', 'HomeController@verify');
