<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\Public\ServiceController as PublicServiceController;
use App\Http\Controllers\Api\V1\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Api\V1\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Api\V1\Admin\OrderManagementController;
use App\Http\Middleware\EnsureUserHasRole;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/services', [PublicServiceController::class, 'index']);
    Route::get('/services/{id}', [PublicServiceController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Customer
        Route::middleware(EnsureUserHasRole::class.':customer')->group(function () {
            Route::post('/orders', [CustomerOrderController::class, 'store']);
            Route::get('/orders/my', [CustomerOrderController::class, 'index']);
        });

        // Admin
        Route::middleware(EnsureUserHasRole::class.':admin')->prefix('admin')->group(function () {
            Route::post('/services', [AdminServiceController::class, 'store']);
            Route::get('/orders', [OrderManagementController::class, 'index']);
            Route::patch('/orders/{id}/status', [OrderManagementController::class, 'updateStatus']);
        });
    });
});
