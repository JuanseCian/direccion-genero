<?php

use App\Http\Controllers\frontend\MasculinidadesCasoController;

Route::prefix('masculinidades')->group(function () {
    Route::get('/', [MasculinidadesCasoController::class, 'index'])->name('masculinidades.index');
    
    Route::get('/listado', [MasculinidadesCasoController::class, 'listado'])->name('masculinidades.listado');
    
    Route::get('/create', [MasculinidadesCasoController::class, 'create'])->name('masculinidades.create');
    Route::post('/store', [MasculinidadesCasoController::class, 'store'])->name('masculinidades.store');

    Route::get('/edit/{id}', [MasculinidadesCasoController::class, 'edit'])->name('masculinidades.edit');
    Route::put('/update/{id}', [MasculinidadesCasoController::class, 'update'])->name('masculinidades.update');

    route::delete('/destroy/{id}', [MasculinidadesCasoController::class, 'destroy'])->name('masculinidades.destroy');

});