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

Route::prefix('orders')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [ProviderOrderController::class, 'index']);
    Route::middleware('auth:sanctum')->put('/{order}/edit', [ProviderOrderController::class, 'updateStatus']);
    Route::middleware('auth:sanctum')->get('/cancel-reasons', OrderCancelReasonListController::class);
});
Route::middleware('auth:sanctum')->get('products', GetProductByNameController::class);
Route::middleware('auth:sanctum')->get('variants', GetEntityProductVariantsController::class);

Route::prefix('entity-product')->group(function () {
    Route::middleware('auth:sanctum')->post('/', [ProviderEntityProductController::class, 'store']);
    Route::middleware('auth:sanctum')->put('/{entityProduct}', [ProviderEntityProductController::class, 'update']);
});

Route::prefix('branch')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [ProviderBranchController::class, 'show']);
    Route::middleware('auth:sanctum')->put('/{branch}', [ProviderBranchController::class, 'updateScheduleBranch']);
});
