<?php

// 1. Asegúrate de que el path sea correcto
use App\Http\Controllers\frontend\IveCasoController; 

// 2. En la definición de la ruta
Route::group(['prefix' => 'ive', 'as' => 'frontend.areas.ive.'], function () {
    Route::get('/', [IveCasoController::class, 'index'])->name('index'); 
    Route::get('/listado', [IveCasoController::class, 'listado'])->name('listado'); 
    Route::get('/crear', [IveCasoController::class, 'create'])->name('create');
    Route::post('/guardar', [IveCasoController::class, 'store'])->name('store');
    Route::get('/{id}/editar', [IveCasoController::class, 'edit'])->name('edit');
    Route::put('/{id}/actualizar', [IveCasoController::class, 'update'])->name('update');

    Route::delete('/{id}/eliminar', [IveCasoController::class, 'destroy'])->name('destroy');
});