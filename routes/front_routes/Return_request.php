<?php
Route::get('retour', [App\Http\Controllers\Return_requestController::class, 'view'])->name('Return_request');
Route::post('add-request', [App\Http\Controllers\Return_requestController::class, 'create'])->name('Return_request.create');
Route::get('imprimer/{id}', [App\Http\Controllers\DynamicPDFController::class, 'index'])->name('imprimer');
Route::get('imprimer/pdf/{id}', [App\Http\Controllers\DynamicPDFController::class, 'pdf'])->name('DynamicPDFController.pdf');
