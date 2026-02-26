<?php
use App\Http\Controllers\backend\BarrioController;

Route::resource('barrios', BarrioController::class);

Route::prefix('panel')->group(function () {

    Route::resource('barrios', BarrioController::class);    
});