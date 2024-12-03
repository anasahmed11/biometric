<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/biometric-login', [AuthController::class, 'biometricLogin']);
});

Route::group(['prefix' => 'auth','middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register-biometric', [AuthController::class, 'biometricRegister']);
});

