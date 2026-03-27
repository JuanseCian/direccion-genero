<?php

use App\Http\Controllers\backend\EncargadoController;

Route::group(['prefix'=>'backend','as'=>'backend.'],function(){

    Route::resource('encargados', EncargadoController::class);

});