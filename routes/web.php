<?php

use Illuminate\Support\Facades\Route;

Route::prefix('')->group(__DIR__ . '/auth.php');
Route::prefix('')->group(__DIR__ . '/profile.php');

Route::middleware('guest')->group(function () {
    Route::view('/', 'index')->name('index');
});

Route::middleware('auth')->group(function () {
    Route::view('home', 'home')->name('home');
});
