<?php

Route::resource(
        'backend/situaciones-habitacionales',
        App\Http\Controllers\backend\SituacionHabitacionalController::class
        )->names('backend.situaciones-habitacionales');