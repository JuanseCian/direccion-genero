<?php

Route::prefix('genero')->group(function () {

    Route::get('/', function () {
        return view('frontend.areas.genero.index');
    })->name('genero.index');

});