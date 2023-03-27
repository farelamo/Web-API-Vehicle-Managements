<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EmployeeController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth.api')->group(function () {

    Route::resource('employee', EmployeeController::class);
    Route::resource('user', UserController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('vehicle', VehicleController::class);

    Route::prefix('spv-admin')->group(function () {
        Route::get('/', [HistoryController::class, 'spvAdminGet']);
        Route::put('/{id}', [HistoryController::class, 'spvAdminApprove']);
    });

    Route::prefix('spv-employee')->group(function () {
        Route::get('/', [HistoryController::class, 'spvEmployeeGet']);
        Route::put('/{id}', [HistoryController::class, 'spvEmployeeApprove']);
    });
});