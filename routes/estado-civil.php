<?php

use App\Http\Controllers\backend\EstadoCivilController;

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {

    Route::resource('estado-civil', EstadoCivilController::class);
    
});