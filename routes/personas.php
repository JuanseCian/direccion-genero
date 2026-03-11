<?php

use App\Http\Controllers\PersonaController;

Route::resource('personas', PersonaController::class);

//ruta para cud
Route::get('/personas/{id}/cud/ver', [App\Http\Controllers\PersonaController::class, 'verArchivoCud'])->name('personas.ver_cud');
Route::get('/personas/{id}/cud/descargar', [App\Http\Controllers\PersonaController::class, 'descargarArchivoCud'])->name('personas.descargar_cud');