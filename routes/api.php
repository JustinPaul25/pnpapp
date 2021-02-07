<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RankController;
use App\Http\Controllers\Api\CrimeController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReportStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () 
{
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/report', [ReportController::class, 'index']);
});

//Police Ranks
Route::get('/ranks', [RankController::class, 'index']);
//Crime Type
Route::get('/crime-type', [CrimeController::class, 'index']);
//Report Status list
Route::get('/report-status-list', [ReportStatusController::class, 'index']);
