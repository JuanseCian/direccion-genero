<?php

Route::get('/manuales', function () {
    $path = public_path('manuales/manual.pdf');

    if (!file_exists($path)) {
        dd('NO EXISTE EL ARCHIVO', $path);
    }

    return response()->download($path);
})->name('manuales');