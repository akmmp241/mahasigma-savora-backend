<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
        Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
        Route::get('/user', [AuthController::class, 'get'])->middleware('auth:sanctum');
        Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::middleware(['auth:sanctum'])->group(function () {

    });

});