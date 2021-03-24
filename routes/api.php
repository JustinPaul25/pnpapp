<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RankController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CrimeController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Resources\User\User as UserResource;
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
        return new UserResource($request->user());
    });
});

//Police Ranks
Route::get('/ranks', [RankController::class, 'index']);
//Crime Type
Route::get('/crime-type', [CrimeController::class, 'index']);
//Report Status list
Route::get('/report-status-list', [ReportStatusController::class, 'index']);
//missing person list
Route::get('/missing-person-list', [ReportController::class, 'missingPerson']);
//most wanted list
Route::get('/wanted-list', [ReportController::class, 'mostWanted']);
//lost and found list
Route::get('/lost-and-found-list', [ReportController::class, 'lostAndFound']);
//register user
Route::post('/register', [UserController::class, 'store']);
//logout
Route::get('/logout', [UserController::class, 'logout']);
Route::post('/report', [ReportController::class, 'store']);
Route::get('/report/{user}/approved', [ReportController::class, 'approvedReports']);
Route::post('/login', [AuthController::class, 'login']);
