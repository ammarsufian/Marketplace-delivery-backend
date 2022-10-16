<?php

use Illuminate\Support\Facades\Route;
use App\Domains\OrderManagement\Http\Controllers\ProviderOrderController;
use App\Domains\AccountManagement\Http\Controllers\ProviderBranchController;
use App\Domains\Authentication\Http\Controllers\ProviderAuthenticationController;
use App\Domains\OrderManagement\Http\Controllers\OrderCancelReasonListController;

Route::post('/login', [ProviderAuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ProviderAuthenticationController::class, 'logout']);
    Route::post('/deactivate', [ProviderAuthenticationController::class, 'deactivate']);

    Route::prefix('orders')->group(function () {
        Route::get('/', [ProviderOrderController::class, 'index']);
        Route::put('/{order}/edit', [ProviderOrderController::class, 'updateStatus']);
        Route::get('/cancel-reasons', OrderCancelReasonListController::class);
    });

    Route::prefix('branch')->group(function () {
        Route::get('/', [ProviderBranchController::class, 'show']);
        Route::put('/active', [ProviderBranchController::class, 'changeStatus']);
    });
});
