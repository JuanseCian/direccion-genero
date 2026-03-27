<?php

Route::resource(
        'backend/situaciones-sanitarias',
        App\Http\Controllers\backend\SituacionSanitariaController::class
        )->names('backend.situaciones-sanitarias');