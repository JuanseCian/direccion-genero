<?php
use App\Http\Controllers\Stats\StatsController;

Route::prefix('estadisticas')->name('stats.')->group(function () {

    Route::get('/', [StatsController::class, 'dashboard'])->name('dashboard');

    Route::get('/genero', [StatsController::class, 'genero'])->name('genero');
    Route::get('/masculinidades', [StatsController::class, 'masculinidades'])->name('masculinidades');
    Route::get('/ive', [StatsController::class, 'ive'])->name('ive');

    Route::get('/genero/imprimir', [StatsController::class, 'generoPrint'])->name('genero.print');
});