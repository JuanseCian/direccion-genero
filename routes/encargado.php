<?php

use App\Http\Controllers\Backend\EncargadoController;

Route::group(['prefix'=>'backend','as'=>'backend.'],function(){

    Route::resource('encargados', EncargadoController::class);

});