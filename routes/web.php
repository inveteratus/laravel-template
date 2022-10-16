<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\Password\RecoveryController;
use App\Http\Controllers\Auth\Password\ResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('', IndexController::class)->name('index');
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('password/recovery', [RecoveryController::class, 'create'])->name('password.recovery');
    Route::post('password/recovery', [RecoveryController::class, 'store']);
    Route::get('password/reset', [ResetController::class, 'create'])->name('password.reset');
    Route::post('password/reset', [ResetController::class, 'store']);
});
Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('home', HomeController::class)->name('home');
    Route::get('welcome', WelcomeController::class)->name('welcome');
});
