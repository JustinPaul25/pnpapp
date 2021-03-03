<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

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
    if(auth()->user()) {
        if(auth()->user()->isComplainant()) {
            auth()->user()->logout();
        } else if (auth()->user()->isBrgyAdmin()) {
            return view('crime-report');
        } else {
            return view('home');
        }
    } else {
        return view('auth.login');
    }
});

Route::get('/register', 'UserController@register')->name('register-user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::view('reports', 'crime-report')->name('reports');

    Route::view('setting', 'setting')->name('setting');
    Route::view('change-password', 'change-password')->name('change-password');
    Route::put('change-password/{user}', [UserController::class, 'changePassword']);

    Route::view('users', 'users')->name('users');
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::get('user-detail', [UserController::class, 'detail']);
    Route::get('getUsers', [UserController::class, 'list']);
    Route::post('check-email', [UserController::class, 'checkMail']);

    Route::post('report', [ReportController::class, 'store']);
    Route::post('report-update', [ReportController::class, 'update']);
    Route::get('getReports', [ReportController::class, 'list']);
    Route::get('report-solved/{caseReport}', [ReportController::class, 'solved']);
    Route::get('report-discard/{caseReport}', [ReportController::class, 'discard']);
    Route::get('report-approved/{caseReport}', [ReportController::class, 'approved']);
    Route::get('get-all-reports', [ReportController::class, 'all']);
    Route::get('get-solved', [ReportController::class, 'getSolved']);
    Route::get('get-approved', [ReportController::class, 'getApproved']);
    Route::get('get-discard', [ReportController::class, 'getDiscard']);
    Route::get('get-pending', [ReportController::class, 'getPending']);

    Route::get('report-print/{caseReport}', [ReportController::class, 'print']);

    Route::get('getRanks', [RankController::class, 'list']);
});
