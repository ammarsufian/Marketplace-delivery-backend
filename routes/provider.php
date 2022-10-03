<?php

use Illuminate\Support\Facades\Route;
use App\Domains\OrderManagement\Http\Controllers\ProviderOrderController;
use App\Domains\AccountManagement\Http\Controllers\ProviderBranchController;
use App\Domains\ProductManagement\Http\Controllers\GetProductByNameController;
use App\Domains\Authentication\Http\Controllers\ProviderAuthenticationController;
use App\Domains\OrderManagement\Http\Controllers\OrderCancelReasonListController;
use App\Domains\ProductManagement\Http\Controllers\ProviderEntityProductController;
use App\Domains\ProductManagement\Http\Controllers\GetEntityProductVariantsController;

Route::post('/login', [ProviderAuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ProviderAuthenticationController::class, 'logout']);
    Route::post('/deactivate', [ProviderAuthenticationController::class, 'deactivate']);

    Route::prefix('orders')->group(function () {
        Route::get('/', [ProviderOrderController::class, 'index']);
        Route::put('/{order}/edit', [ProviderOrderController::class, 'updateStatus']);
        Route::get('/cancel-reasons', OrderCancelReasonListController::class);
    });

//    Route::get('products', GetProductByNameController::class);
//    Route::get('variants', GetEntityProductVariantsController::class);
//    Route::prefix('entity-product')->group(function () {
//        Route::post('/', [ProviderEntityProductController::class, 'store']);
//        Route::put('/{entityProduct}', [ProviderEntityProductController::class, 'update']);
//    }); //TODO::comment this changes until take decision from business side

    Route::prefix('branch')->group(function () {
        Route::get('/', [ProviderBranchController::class, 'show']);
        Route::get('/active', [ProviderBranchController::class, 'showActive']);
        Route::put('/active', [ProviderBranchController::class, 'updateActive']);
        Route::put('/{branch}', [ProviderBranchController::class, 'updateScheduleBranch']);
    });
});
