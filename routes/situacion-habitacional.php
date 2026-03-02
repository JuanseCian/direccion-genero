<?php

Route::resource(
        'backend/situaciones-habitacionales',
        App\Http\Controllers\Backend\SituacionHabitacionalController::class
        )->names('backend.situaciones-habitacionales');