<?php

Route::resource(
        'backend/tipo-violencia',
        App\Http\Controllers\Backend\TipoViolenciaController::class
        )->names('backend.tipo-violencia');