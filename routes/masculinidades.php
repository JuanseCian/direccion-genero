<?php

Route::prefix('masculinidades')->group(function () {

    Route::get('/', function () {
        return view('frontend.areas.masculinidades.index');
    })->name('masculinidades.index');

});