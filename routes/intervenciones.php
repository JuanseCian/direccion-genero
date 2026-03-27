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
'/genero/intervenciones/{id}/edit',
[DireccionGeneroIntervencionController::class, 'edit']
)->name('genero.intervenciones.edit');

Route::put(
'/genero/intervenciones/{id}',
[DireccionGeneroIntervencionController::class, 'update']
)->name('genero.intervenciones.update');

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
'/masculinidades/intervenciones/{id}/edit',
[MasculinidadesIntervencionController::class,'edit']
)->name('masculinidades.intervenciones.edit');

Route::put(
'/masculinidades/intervenciones/{id}',
[MasculinidadesIntervencionController::class,'update']
)->name('masculinidades.intervenciones.update');