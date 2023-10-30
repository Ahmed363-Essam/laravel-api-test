<?php

use App\Http\Controllers\Api\SettingsCController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\DomainController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdController;

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

/****** Auth Controller ****/

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('/register', [AuthController::class, 'createUser']);
    Route::post('/login', [AuthController::class, 'loginUser']);

    Route::post('/logout', [AuthController::class, 'logoutuser'])->middleware('auth:sanctum');
    Route::post('/profile', [AuthController::class, 'userprofile'])->middleware('auth:sanctum');
});

Route::apiResource('settings', SettingsCController::class);

Route::get('cities', CityController::class);

Route::get('District/{id}', DistrictController::class);

Route::apiResource('Message', MessageController::class);

Route::get('domains', DomainController::class);

Route::group([
    'controller' => AdController::class
], function () {

    Route::get('ads', 'index');
    Route::get('getlatets',  'getlatets');
    Route::get('domain/{domain_id}', 'domain');

    Route::group([
        'middleware' => 'auth:sanctum'
    ], function () {
        Route::post('store', 'store');
        Route::delete('delete', 'delete');

        Route::get('myads', 'myads');
    });
});
