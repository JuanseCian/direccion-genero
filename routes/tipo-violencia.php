<?php

Route::resource(
        'backend/tipo-violencia',
        App\Http\Controllers\backend\TipoViolenciaController::class
        )->names('backend.tipo-violencia');