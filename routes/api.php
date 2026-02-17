<?php

use App\Http\Controllers\Api\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\AuthController;

/**
 * @group Auth
 * @header Content-Type application/json
 * @header Accept application/json
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/**
 * @group Auth Protected
 * @header Content-Type application/json
 * @header Accept application/json
 * @header Authorization Bearer {token}
 * @authenticated
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('sales', SaleController::class);
});
