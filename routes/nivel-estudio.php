<?php
use App\Http\Controllers\Backend\NivelEstudioController;

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::resource('estado-civil', EstadoCivilController::class);
    // Nueva ruta:
    Route::resource('nivel-estudio', NivelEstudioController::class);
});