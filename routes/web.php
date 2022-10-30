<?php

use Illuminate\Support\Facades\Route;
use App\Domains\AccountManagement\Http\Controllers\RiderController;
use App\Domains\AccountManagement\Http\Controllers\PartnerController;
use App\Domains\AccountManagement\Http\Controllers\NewJoinerController;
use App\Domains\AccountManagement\Http\Controllers\IndexContactUsController;
use App\Domains\AccountManagement\Http\Controllers\CreateContactUsController;
use App\Domains\ApplicationManagement\Http\Controllers\LandingPageController;
use App\Domains\ApplicationManagement\Http\Controllers\TermsConditionsController;

Route::middleware('localization')->group(function () {
    Route::get('/', LandingPageController::class);
    Route::prefix('{lang}')->group(function () {
        Route::get('/', LandingPageController::class)->name('landing-page');
        Route::get('/rider', RiderController::class)->name('rider');
        Route::get('/partner', PartnerController::class)->name('partner');
        Route::get('/contact', IndexContactUsController::class)->name('contact');
        Route::get('/terms-and-conditions', TermsConditionsController::class)->name('terms-and-conditions');
        Route::post('/rider', NewJoinerController::class)->name('rider.store');
        Route::post('/partner', NewJoinerController::class)->name('partner.store');
        Route::post('/contact', CreateContactUsController::class)->name('contact.store');
    });
});