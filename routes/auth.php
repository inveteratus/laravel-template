<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')
        ->name('login');
    Route::post('login', LoginController::class);
    Route::view('register', 'auth.register')
        ->name('register');
    Route::post('register', RegisterController::class);
    Route::view('password/recovery', 'auth.forgot-password')
        ->name('forgot-password');
    Route::post('password/recovery', ForgotPasswordController::class);
    Route::view('password/reset', 'auth.reset-password')
        ->name('password.reset');
    Route::post('password/reset', ResetPasswordController::class)
        ->name('password.reset.store');
});

Route::post('logout', LogoutController::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'auth.profile')
        ->name('profile');
    Route::post('profile/update-profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.update-profile');
    Route::post('profile/verify-email', [ProfileController::class, 'verifyEmail'])
        ->name('profile.verify-email');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.change-password');
    Route::delete('profile/delete-account', [ProfileController::class, 'deleteAccount'])
        ->name('profile.delete-account');
    Route::post('profile/change-image', [ProfileController::class, 'changeImage'])
        ->name('profile.change-image');
    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');
});
