<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IveCasoController;
use App\Http\Controllers\frontend\intervenciones\IveIntervencionController;

Route::prefix('ive')
    ->name('frontend.areas.ive.')
    ->group(function () {

        Route::get(
            '/',
            [IveCasoController::class, 'index']
        )->name('index');


        Route::get(
            '/listado',
            [IveCasoController::class, 'listado']
        )->name('listado');


        Route::get(
            '/crear',
            [IveCasoController::class, 'create']
        )->name('create');


        Route::post(
            '/guardar',
            [IveCasoController::class, 'store']
        )->name('store');


        Route::get(
            '/{id}/editar',
            [IveCasoController::class, 'edit']
        )
        ->whereNumber('id')
        ->name('edit');


        Route::put(
            '/{id}/actualizar',
            [IveCasoController::class, 'update']
        )
        ->whereNumber('id')
        ->name('update');


        Route::delete(
            '/{id}/eliminar',
            [IveCasoController::class, 'destroy']
        )
        ->whereNumber('id')
        ->name('destroy');

    });

Route::prefix('ive/intervenciones')
    ->name('ive.intervenciones.')
    ->group(function () {

        Route::get(
            '/create/{caso}',
            [IveIntervencionController::class, 'create']
        )
        ->whereNumber('caso')
        ->name('create');


        Route::post(
            '/store/{caso}',
            [IveIntervencionController::class, 'store']
        )
        ->whereNumber('caso')
        ->name('store');

        Route::get(
            '/adjuntos/{id}/visualizar',
            [IveIntervencionController::class, 'visualizarAdjunto']
        )
        ->whereNumber('id')
        ->name('adjuntos.visualizar');

        Route::get(
            '/{caso}/{intervencion}',
            [IveIntervencionController::class, 'show']
        )
        ->whereNumber('caso')
        ->whereNumber('intervencion')
        ->name('show');

        Route::get(
            '/{id}/edit',
            [IveIntervencionController::class, 'edit']
        )
        ->whereNumber('id')
        ->name('edit');

        Route::put(
            '/{id}',
            [IveIntervencionController::class, 'update']
        )
        ->whereNumber('id')
        ->name('update');

        Route::delete(
            '/{id}',
            [IveIntervencionController::class, 'destroy']
        )
        ->whereNumber('id')
        ->name('destroy');

    });