<?php

use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\DeleteAccountController;
use App\Http\Controllers\Profile\UpdateProfileController;
use App\Http\Controllers\Profile\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::view('', 'profile')
        ->name('index');

    Route::post('update-profile', UpdateProfileController::class)
        ->name('update-profile');

    Route::post('verify-email', VerifyEmailController::class)
        ->name('verify-email');

    Route::post('change-password', ChangePasswordController::class)
        ->name('change-password');

    Route::delete('delete-account', DeleteAccountController::class)
        ->name('delete-account');
});
