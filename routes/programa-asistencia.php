<?php
    Route::resource(
        'backend/programas-asistencia',
        App\Http\Controllers\Backend\ProgramaAsistenciaController::class
        )->names('backend.programas-asistencia');