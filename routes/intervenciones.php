<?php
use App\Http\Controllers\frontend\intervenciones\IveIntervencionController;
use App\Http\Controllers\Frontend\Intervenciones\DireccionGeneroIntervencionController;
use App\Http\Controllers\Frontend\Intervenciones\MasculinidadesIntervencionController;

Route::post('ive/casos/{id}/intervenciones', [IveIntervencionController::class, 'store'])
    ->name('frontend.areas.ive.intervenciones.store');


Route::post('direccion-genero-intervenciones/{casoId}', [DireccionGeneroIntervencionController::class, 'store'])
    ->name('frontend.areas.genero.intervenciones.store');


Route::post('masculinidades/intervenciones/{casoId}', [MasculinidadesIntervencionController::class, 'store'])
    ->name('masculinidades.intervenciones.store');