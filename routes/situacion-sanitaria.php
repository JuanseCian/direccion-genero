<?php

Route::resource(
        'backend/situaciones-sanitarias',
        App\Http\Controllers\Backend\SituacionSanitariaController::class
        )->names('backend.situaciones-sanitarias');