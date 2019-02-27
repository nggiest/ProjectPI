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

Route::get('/', function () {
    if(!Session::get('login')){
        return redirect('login');
    }
    else{
        return view('home');
    }
    
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/project', 'ProjectController');
Route::resource('/user', 'UserController');
Route::resource('/daily', 'ReportController');
Route::resource('/document', 'ProjectFileController');
Route::post('/report','ReportActivityController@store')->name('report.save');
Route::get('/daily/getDaily/{id}', 'ReportController@getData');

