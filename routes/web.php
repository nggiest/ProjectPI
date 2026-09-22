<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\ReportActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (! Session::get('login')) {
        return redirect('login');
    }

    return view('home');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


Route::resource('/project', ProjectController::class);

Route::resource('/user', UserController::class);

Route::get('/user/cp/{id}', [UserController::class, 'changepassword'])
    ->name('user.change');

Route::match(
    ['put', 'patch'],
    '/user/cp/{id}',
    [UserController::class, 'gantipwd']
)->name('user.ganti');

Route::resource('/daily', ReportController::class);

Route::get('/daily/getDaily/{id}', [ReportController::class, 'getData']);

Route::resource('/document', ProjectFileController::class);

Route::post('/report', [ReportActivityController::class, 'store'])
    ->name('report.save');