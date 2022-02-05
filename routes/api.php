<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\VisitController;
use App\Http\Controllers\API\AnalyticController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    //Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::resource('leads', LeadController::class);
    Route::resource('visits', VisitController::class);
    Route::get('analytic', [AnalyticController::class, 'analytic']);
});

