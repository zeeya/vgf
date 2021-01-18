<?php
Route::get('retour', [App\Http\Controllers\Return_requestController::class, 'view'])->name('Return_request')->middleware('auth');
Route::get('retour/list', [App\Http\Controllers\Return_requestController::class, 'list'])->name('listReturn_request')->middleware('auth');
Route::get('retour/modifier/{id}', [App\Http\Controllers\Return_requestController::class, 'edit_view'])->name('editReturn_request')->middleware('auth');
Route::post('retour/editer/{id}', [App\Http\Controllers\Return_requestController::class, 'edit'])->name('editerReturn_request')->middleware('auth');
Route::get('retour/supprimer/{id}', [App\Http\Controllers\Return_requestController::class, 'delete'])->name('supprimerReturn_request')->middleware('auth');

Route::post('add-request', [App\Http\Controllers\Return_requestController::class, 'create'])->name('Return_request.create')->middleware('auth');
Route::get('imprimer/{id}', [App\Http\Controllers\DynamicPDFController::class, 'index'])->name('imprimer')->middleware('auth');
Route::get('imprimer/pdf/{id}', [App\Http\Controllers\DynamicPDFController::class, 'pdf'])->name('DynamicPDFController.pdf')->middleware('auth');
