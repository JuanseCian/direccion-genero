<?php
use App\Http\Controllers\backend\MedidaCautelarController;

Route::get('medidas-cautelares', [MedidaCautelarController::class, 'index'])->name('medidas-cautelares.index');
Route::get('medidas-cautelares/create', [MedidaCautelarController::class, 'create'])->name('medidas-cautelares.create');
Route::post('medidas-cautelares', [MedidaCautelarController::class, 'store'])->name('medidas-cautelares.store');
Route::get('medidas-cautelares/{id}/edit', [MedidaCautelarController::class, 'edit'])->name('medidas-cautelares.edit');
Route::put('medidas-cautelares/{id}', [MedidaCautelarController::class, 'update'])->name('medidas-cautelares.update');
Route::delete('medidas-cautelares/{id}', [MedidaCautelarController::class, 'destroy'])->name('medidas-cautelares.destroy');