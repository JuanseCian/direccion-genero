<?php
use App\Http\Controllers\backend\NivelEstudioController;

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::resource('nivel-estudio', NivelEstudioController::class);
});