<?php
use App\Http\Controllers\Frontend\DireccionGeneroController;

Route::resource('genero', DireccionGeneroController::class);

Route::prefix('genero')->group(function () {

    Route::get('/', function () {
        return view('frontend.areas.genero.index');
    })->name('genero.index');


    
});

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    
    Route::get('genero/listado', [DireccionGeneroController::class, 'listado'])->name('genero.listado');
    
    Route::resource('genero', DireccionGeneroController::class)->except(['index']);
});