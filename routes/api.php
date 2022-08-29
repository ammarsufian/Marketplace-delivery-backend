<?php

use App\Domains\AccountManagement\Http\Controllers\AddressesController;
use App\Domains\AccountManagement\Http\Controllers\BranchesController;
use App\Domains\ApplicationManagement\Http\Controllers\CategoryController;
use App\Domains\ApplicationManagement\Http\Controllers\VersionController;
use App\Domains\Authentication\Http\Controllers\AuthenticationController;
use App\Domains\Authentication\Http\Controllers\DeactivateUserController;
use App\Domains\Authentication\Http\Controllers\FirebaseController;
use App\Domains\OrderManagement\Http\Controllers\ApplyPromoCodeController;
use App\Domains\OrderManagement\Http\Controllers\CartController;
use App\Domains\OrderManagement\Http\Controllers\DeleteCartItemController;
use App\Domains\OrderManagement\Http\Controllers\OrderController;
use App\Domains\ProductManagement\Http\Controllers\EntityProductController;
use App\Domains\ProductManagement\Http\Controllers\FavoriteController;
use App\Domains\AccountManagement\Http\Controllers\EditProfileController;
use App\Domains\Transaction\Http\Controllers\CreditCardController;
use App\Domains\Transaction\Http\Controllers\PaymentMethodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthenticationController::class, 'logout']);
    Route::middleware('auth:sanctum')->put('/fcm-token', FirebaseController::class);
    Route::middleware('auth:sanctum')->resource('address', AddressesController::class);
    Route::middleware('auth:sanctum')->put('/profile', [EditProfileController::class, 'update']);
    Route::middleware('auth:sanctum')->resource('/credit-card', CreditCardController::class);
    Route::middleware('auth:sanctum')->post('/deactivate', DeactivateUserController::class);
});
Route::prefix('categories')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [CategoryController::class, 'index']);
});
Route::prefix('locations')->group(function () {
    Route::middleware('auth:sanctum')->get('/', BranchesController::class);
});
Route::middleware('auth:sanctum')->get('branch/{branch}/products', EntityProductController::class);
Route::middleware('auth:sanctum')->resource('favorites', FavoriteController::class);
Route::middleware('auth:sanctum')->resource('cart', CartController::class)->only('store', 'index');
Route::middleware('auth:sanctum')->delete('cart/{cartItem}', DeleteCartItemController::class);
Route::middleware('auth:sanctum')->post('promo-code/apply', ApplyPromoCodeController::class);
Route::middleware('auth:sanctum')->get('/payment-methods', PaymentMethodController::class);
Route::middleware('auth:sanctum')->resource('order', OrderController::class);

Route::get('/version', VersionController::class);


