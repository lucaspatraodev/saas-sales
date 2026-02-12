<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;

use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('tenants', TenantController::class)->only(['index', 'store']);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('customers', CustomerController::class);
});
