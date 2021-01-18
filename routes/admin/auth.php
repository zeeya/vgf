<?php
use Illuminate\Support\Facades\Route;



    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');


    Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);



