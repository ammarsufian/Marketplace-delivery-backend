<?php

use Illuminate\Support\Facades\Route;
use App\Domains\AccountManagement\Http\Controllers\RiderController;
use App\Domains\AccountManagement\Http\Controllers\PartnerController;
use App\Domains\AccountManagement\Http\Controllers\NewJoinerController;
use App\Domains\AccountManagement\Http\Controllers\InvitedUserController;
use App\Domains\AccountManagement\Http\Controllers\indexContactUsController;
use App\Domains\AccountManagement\Http\Controllers\CreateContactUsController;
use App\Domains\ApplicationManagement\Http\Controllers\LandingPageController;

Route::get('/', LandingPageController::class)->name('landing-page');
Route::get('/rider', RiderController::class)->name('rider');
Route::get('/partner', PartnerController::class)->name('partner');
Route::post('/rider', NewJoinerController::class)->name('rider.store');
Route::post('/partner', NewJoinerController::class)->name('partner.store');
Route::get('/contact', indexContactUsController::class)->name('contact');
Route::post('/contact', CreateContactUsController::class)->name('contact.store');


Route::get('/user/{referral_key}/accept-invitation', [InvitedUserController::class,'show'])->name('users.invitation');

Route::post('/user/{referral_key}/check-data', [InvitedUserController::class,'check'])->name('users.checked');
Route::post('/user/{referral_key}/register', [InvitedUserController::class,'create'])->name('users.created');
