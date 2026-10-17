<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// ROUTE AUTH
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function(){
    
    Route::middleware('role:admin')->group(function(){
        // ROUTE USER
        Route::apiResource('users', UserController::class)->only(['index','store','destroy']);

        // ROUTE CATEGORY
        Route::apiResource('categories', CategoryController::class)->only(['store','update','destroy']);

        // ROUTE PERIOD
        Route::apiResource('periods', PeriodController::class)->only(['store','update','destroy']);
    });

    Route::middleware('role:admin,member')->group(function(){
        Route::apiResource('users',UserController::class)->only(['update']);

        // ROUTE CATEGORY
        Route::apiResource('categories', CategoryController::class)->only(['index']);

        // ROUTE PERIOD
        Route::apiResource('periods', PeriodController::class)->only(['index']);

        // ROUTE TASK
        Route::apiResource('tasks', TaskController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    
});

// apiResource otomatis membuat 5 method route ini:
// GET     /resource          → index
// POST    /resource          → store
// GET     /resource/{id}     → show
// PUT     /resource/{id}     → update
// destory  /resource/{id}     → destroy