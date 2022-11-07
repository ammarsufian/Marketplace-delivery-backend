<?php

use Illuminate\Support\Facades\Route;
use App\Domains\AccountManagement\Http\Controllers\RiderController;
use App\Domains\AccountManagement\Http\Controllers\PartnerController;
use App\Domains\AccountManagement\Http\Controllers\NewJoinerController;
use App\Domains\AccountManagement\Http\Controllers\IndexContactUsController;
use App\Domains\AccountManagement\Http\Controllers\CreateContactUsController;
use App\Domains\AccountManagement\Http\Controllers\InvitedUserController;
use App\Domains\ApplicationManagement\Http\Controllers\LandingPageController;
use App\Domains\ApplicationManagement\Http\Controllers\TermsConditionsController;

Route::middleware('localization')->group(function () {
    Route::get('/', LandingPageController::class);
    Route::get('{lang}/main', LandingPageController::class)->name('landing-page');
    Route::get('{lang}/rider', RiderController::class)->name('rider');
    Route::get('{lang}/partner', PartnerController::class)->name('partner');
    Route::get('{lang}/contact', IndexContactUsController::class)->name('contact');
    Route::get('{lang}/terms-and-conditions', TermsConditionsController::class)->name('terms-and-conditions');
    Route::post('{lang}/rider', NewJoinerController::class)->name('rider.store');
    Route::post('{lang}/partner', NewJoinerController::class)->name('partner.store');
    Route::post('{lang}/contact', CreateContactUsController::class)->name('contact.store');
    Route::get('{lang}/user/{referral_key}/accept-invitation', [InvitedUserController::class,'show'])->name('users.invitation');
});

Route::post('/user/{referral_key}/check-data', [InvitedUserController::class,'check'])->name('users.checked');
Route::post('/user/{referral_key}/register', [InvitedUserController::class,'create'])->name('users.created');
