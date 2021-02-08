<?php

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
        return view('home');
    } else {
        return view('auth.login');
    }
});

Route::get('/register', 'UserController@register')->name('register-user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::view('reports', 'crime-report')->name('reports');

    Route::view('users', 'users')->name('users');
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::get('user-detail', [UserController::class, 'detail']);
    Route::get('getUsers', [UserController::class, 'list']);
    Route::post('check-email', [UserController::class, 'checkMail']);

    Route::post('report', [ReportController::class, 'store']);

    Route::get('getRanks', [RankController::class, 'list']);
});
