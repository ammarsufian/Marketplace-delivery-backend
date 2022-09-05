<?php

use Illuminate\Support\Facades\Route;
use App\Domains\AccountManagement\Http\Controllers\RiderController;
use App\Domains\AccountManagement\Http\Controllers\PartnerController;
use App\Domains\AccountManagement\Http\Controllers\ContactUsController;
use App\Domains\AccountManagement\Http\Controllers\NewJoinerController;
use App\Domains\ApplicationManagement\Http\Controllers\LandingPageController;
use App\Domains\AccountManagement\Http\Controllers\IndexInvitedUserController;
use App\Domains\AccountManagement\Http\Controllers\CreateInvitedUserController;


Route::get('/', LandingPageController::class)->name('landing-page');
Route::get('/rider', RiderController::class)->name('rider');
Route::get('/partner', PartnerController::class)->name('partner');
Route::post('/rider', NewJoinerController::class)->name('rider.store');
Route::post('/partner', NewJoinerController::class)->name('partner.store');
Route::resource('/contact', ContactUsController::class,
        ['names' => ['index' => 'contact','store' => 'contact.store',],]
    )->only(['index', 'store']); //TODO::make this seperate route get,post methods

Route::get('/user/{referral_key}/accept-invitation', IndexInvitedUserController::class)->name('users.invitation');

Route::post('/user/{referral_key}/register/',CreateInvitedUserController::class)->name('users.invited');
