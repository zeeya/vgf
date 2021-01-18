<?php

Route::get('/list-requests', [App\Http\Controllers\Admin\RequestController::class, 'index'])->name('list.requests');
Route::get('/fetch-requests', [App\Http\Controllers\Admin\RequestController::class, 'fetch'])->name('fetch.data.requests');
Route::get('/edit-requests/{id}', [App\Http\Controllers\Admin\RequestController::class, 'edit'])->name('edit.request');
Route::put('/update-requests/{id}', [App\Http\Controllers\Admin\RequestController::class, 'update'])->name('update.request');
Route::delete('/delete-requests', [App\Http\Controllers\Admin\RequestController::class, 'delete'])->name('delete.request');
