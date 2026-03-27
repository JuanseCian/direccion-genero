<?php
use App\Http\Controllers\stats\StatsController;

Route::prefix('estadisticas')->name('stats.')->group(function () {

    Route::get('/', [StatsController::class, 'dashboard'])->name('dashboard');

    Route::get('/genero', [StatsController::class, 'genero'])->name('genero');
    
    
    Route::get('/masculinidades', [StatsController::class, 'masculinidades'])->name('masculinidades');
    Route::get('/ive', [StatsController::class, 'ive'])->name('ive');

    Route::get('/genero/imprimir', [StatsController::class, 'generoPrint'])->name('genero.print');

    });
    Route::get('/estadisticas', function () {
        return view('frontend.stats.index');
    })->name('frontend.stats.index');

    Route::get('/estadisticas/intervenciones',
    [StatsController::class,'intervenciones'])
    ->name('frontend.stats.intervenciones');


    Route::get('/stats/genero/export', [StatsController::class, 'exportGenero'])
        ->name('stats.genero.export');

    Route::get('/stats/masculinidades/export', [StatsController::class, 'exportMasculinidades'])
        ->name('stats.masculinidades.export');

    Route::get('/stats/ive/export', [StatsController::class, 'exportIve'])
        ->name('stats.ive.export');
    
    Route::get('/stats/intervenciones/export',
        [StatsController::class,'exportIntervenciones'])
        ->name('stats.intervenciones.export');