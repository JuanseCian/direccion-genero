<?php

use App\Http\Controllers\Backend\EstadoCivilController;

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {

    Route::resource('estado-civil', EstadoCivilController::class);

});