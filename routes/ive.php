<?php

// 1. Asegúrate de que el path sea correcto
use App\Http\Controllers\frontend\IveCasoController; 
use App\Http\Controllers\frontend\intervenciones\IveIntervencionController;
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

Route::prefix('ive/intervenciones')->name('ive.intervenciones.')->group(function () {

    Route::get('create/{caso}', [IveIntervencionController::class, 'create'])->name('create');
    Route::post('store/{caso}', [IveIntervencionController::class, 'store'])->name('store');
    Route::get('{id}/edit', [IveIntervencionController::class, 'edit'])->name('edit');
    Route::put('{id}', [IveIntervencionController::class, 'update'])->name('update');
    Route::delete('{id}', [IveIntervencionController::class, 'destroy'])->name('destroy');

}); 
