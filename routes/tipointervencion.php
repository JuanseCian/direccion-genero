<?php
use App\Http\Controllers\backend\TipoIntervencionController;

Route::resource('tipo-intervencion', TipoIntervencionController::class)
    ->names('backend.tipo-intervencion');