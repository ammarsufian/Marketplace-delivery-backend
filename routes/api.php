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
use App\Domains\ApplicationManagement\Http\Controllers\PackageController;
use App\Domains\Transaction\Http\Controllers\CreditCardController;
use App\Domains\Transaction\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;
use App\Domains\AccountManagement\Http\Controllers\InvitedUserController;

Route::prefix('user')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/logout', [AuthenticationController::class, 'logout']);
        Route::put('/fcm-token', FirebaseController::class);
        Route::resource('address', AddressesController::class);
        Route::put('/profile', [EditProfileController::class, 'update']);
        Route::resource('/credit-card', CreditCardController::class);
        Route::post('/deactivate', DeactivateUserController::class);
        Route::get('/invitation-link', [InvitedUserController::class,'index']);
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
    });
    Route::prefix('locations')->group(function () {
        Route::get('/', BranchesController::class);
    });
    Route::get('branch/{branch}/products', EntityProductController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('cart', CartController::class)->only('store', 'index');
    Route::delete('cart/{cartItem}', DeleteCartItemController::class);
    Route::post('promo-code/apply', ApplyPromoCodeController::class);
    Route::get('/payment-methods', PaymentMethodController::class);
    Route::resource('order', OrderController::class);
    Route::get('/packages', PackageController::class);
});

Route::get('/version', VersionController::class);


