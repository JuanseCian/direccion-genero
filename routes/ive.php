<?php

Route::prefix('ive')->group(function () {

    Route::get('/', function () {
        return view('frontend.areas.ive.index');
    })->name('ive.index');

});