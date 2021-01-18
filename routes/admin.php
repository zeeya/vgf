<?php

use Illuminate\Support\Facades\Route;




Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
Route::get('/edit-profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit.profile');
Route::put('/update-profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update.profile');

/********** user routes *************/
include_once(base_path('routes/admin/user.php'));
//
///********** return_request routes *************/
include_once(base_path('routes/admin/return_request.php'));




