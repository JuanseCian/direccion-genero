<?php
use App\Http\Controllers\backend\EspacioGrupalController;

Route::get('espacios-grupales', [EspacioGrupalController::class, 'index'])->name('espacios-grupales.index');
Route::get('espacios-grupales/create', [EspacioGrupalController::class, 'create'])->name('espacios-grupales.create');
Route::post('espacios-grupales', [EspacioGrupalController::class, 'store'])->name('espacios-grupales.store');
Route::get('espacios-grupales/{id}/edit', [EspacioGrupalController::class, 'edit'])->name('espacios-grupales.edit');    
Route::put('espacios-grupales/{id}', [EspacioGrupalController::class, 'update'])->name('espacios-grupales.update');
Route::delete('espacios-grupales/{id}', [EspacioGrupalController::class, 'destroy'])->name('espacios-grupales.destroy');