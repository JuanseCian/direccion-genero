<?php
use App\Http\Controllers\frontend\DireccionGeneroController;

Route::group(['prefix' => 'genero', 'as' => 'genero.'], function () {
    Route::get('/', [DireccionGeneroController::class, 'index'])->name('index'); 
    
    Route::get('/listado', [DireccionGeneroController::class, 'listado'])->name('listado'); 
    
    Route::get('/crear', [DireccionGeneroController::class, 'create'])->name('create');
    Route::post('/guardar', [DireccionGeneroController::class, 'store'])->name('store');
    
    Route::get('/{id}/editar', [DireccionGeneroController::class, 'edit'])->name('edit');
    Route::put('/{id}/actualizar', [DireccionGeneroController::class, 'update'])->name('update');
    
    Route::delete('/{id}/eliminar', [DireccionGeneroController::class, 'destroy'])->name('destroy');
});