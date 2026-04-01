<?php

use App\Http\Controllers\frontend\DenunciaController;

Route::prefix('denuncias')->group(function () {

    Route::get('/', [DenunciaController::class,'index'])->name('denuncias.index');

    Route::get('/create', [DenunciaController::class,'create'])->name('denuncias.create');
    Route::post('/', [DenunciaController::class,'store'])->name('denuncias.store');

    Route::get('/{id}/edit', [DenunciaController::class,'edit'])->name('denuncias.edit');
    Route::put('/{id}', [DenunciaController::class,'update'])->name('denuncias.update');

    Route::delete('/{id}', [DenunciaController::class,'destroy'])->name('denuncias.destroy');
});