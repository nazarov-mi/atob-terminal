<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::post('/auth', 'AuthController@auth');
Route::get('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

Route::post('/notice/get', 'NoticeController@get');
Route::post('/notice/save', 'NoticeController@save');
Route::get('/notice/edit/{date?}', 'NoticeController@edit');
Route::get('/notice/{date?}', 'NoticeController@view');

Route::post('/get', 'ScheduleController@get');
Route::post('/save', 'ScheduleController@save');
Route::get('/edit/{date?}', 'ScheduleController@edit');
Route::get('/{date?}', 'ScheduleController@view');