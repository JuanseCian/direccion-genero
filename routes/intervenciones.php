<?php
use App\Http\Controllers\frontend\intervenciones\IveIntervencionController;
use App\Http\Controllers\frontend\intervenciones\DireccionGeneroIntervencionController;
use App\Http\Controllers\frontend\intervenciones\MasculinidadesIntervencionController;

//ive
Route::prefix('frontend/areas/ive')->name('frontend.areas.ive.')->group(function () {

    Route::get('intervenciones/create/{caso}', [IveIntervencionController::class, 'create'])
        ->name('intervenciones.create');

    Route::post('intervenciones/store/{caso}', [IveIntervencionController::class, 'store'])
        ->name('intervenciones.store');
        
    Route::get(
        '/ive/intervenciones/adjuntos/{id}/visualizar',
        [IveIntervencionController::class, 'visualizarAdjunto']
    )->name('ive.intervenciones.adjuntos.visualizar');

    Route::get(
        '/ive/{caso}/intervenciones/{intervencion}',
        [IveIntervencionController::class, 'show']
    )->name('ive.intervenciones.show');
    
    Route::get('intervenciones/{intervencion}/edit', [IveIntervencionController::class, 'edit'])
        ->name('intervenciones.edit');

    Route::put('intervenciones/{intervencion}', [IveIntervencionController::class, 'update'])
        ->name('intervenciones.update');

});

//Genero
Route::get(
    '/genero/{id}/intervenciones/create',
    [DireccionGeneroIntervencionController::class, 'create']
)->name('genero.intervenciones.create');

Route::post(
    '/genero/{id}/intervenciones',
    [DireccionGeneroIntervencionController::class, 'store']
)->name('genero.intervenciones.store');

Route::get(
    '/genero/{caso}/intervenciones/{intervencion}',
    [DireccionGeneroIntervencionController::class, 'show']
)->name('genero.intervenciones.show');

Route::get(
    '/genero/intervenciones/adjuntos/{id}/visualizar',
    [DireccionGeneroIntervencionController::class, 'visualizarAdjunto']
)->name('genero.intervenciones.adjuntos.visualizar');

Route::get(
'/genero/intervenciones/{id}/edit',
[DireccionGeneroIntervencionController::class, 'edit']
)->name('genero.intervenciones.edit');

Route::put(
    '/genero/intervenciones/{id}',
    [DireccionGeneroIntervencionController::class, 'update']
)->name('genero.intervenciones.update');

Route::delete(
    '/genero/intervenciones/{id}',
    [DireccionGeneroIntervencionController::class, 'destroy']
)->name('genero.intervenciones.destroy');

//masculinidades
Route::get(
'/masculinidades/{caso}/intervenciones/create',
[MasculinidadesIntervencionController::class,'create']
)->name('masculinidades.intervenciones.create');

Route::post(
'/masculinidades/{caso}/intervenciones',
[MasculinidadesIntervencionController::class,'store']
)->name('masculinidades.intervenciones.store');

Route::get(
    '/masculinidades/intervenciones/adjuntos/{id}/visualizar',
    [MasculinidadesIntervencionController::class, 'visualizarAdjunto']
)->name('masculinidades.intervenciones.adjuntos.visualizar');

Route::get(
    '/masculinidades/{caso}/intervenciones/{intervencion}',
    [MasculinidadesIntervencionController::class, 'show']
)->name('masculinidades.intervenciones.show');  

Route::get(
'/masculinidades/intervenciones/{id}/edit',
[MasculinidadesIntervencionController::class,'edit']
)->name('masculinidades.intervenciones.edit');

Route::put(
'/masculinidades/intervenciones/{id}',
[MasculinidadesIntervencionController::class,'update']
)->name('masculinidades.intervenciones.update');

Route::delete(
'/masculinidades/intervenciones/{id}',
[MasculinidadesIntervencionController::class,'destroy']
)->name('masculinidades.intervenciones.destroy');
