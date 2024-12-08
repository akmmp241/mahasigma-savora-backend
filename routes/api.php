<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\FoodController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
        Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
        Route::get('/user', [AuthController::class, 'get'])->middleware('auth:sanctum');
        Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::get('/categories', [CategoryController::class, 'list'])->middleware('guest');

    Route::get('/foods', [FoodController::class, 'list'])->middleware('guest');

    Route::middleware(['auth:sanctum'])->group(function () {

    });
});