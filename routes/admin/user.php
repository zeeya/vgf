<?php


/* * ******  User Start ********** */
Route::get('/list-users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('list.users');
Route::get('/create-user',[App\Http\Controllers\Admin\UserController::class, 'create'])->name('create.user');
Route::post('/store-user', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store.user');
Route::get('/edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit.user');
Route::put('/update-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update.user');
Route::delete('/delete-user', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('delete.user');
Route::get('/fetch-users', [App\Http\Controllers\Admin\UserController::class, 'fetch'])->name('fetch.data.users');
