<?php
use App\Http\Controllers\backend\PapeleraController;

Route::middleware(['auth', 'admin'])->prefix('backend')->name('backend.')->group(function () {
    
    // Ruta principal de la papelera
    Route::get('/papelera', [PapeleraController::class, 'index'])->name('papelera.index');
    
    // Ruta para restaurar
    Route::post('/papelera/restore/{tipo}/{id}', [PapeleraController::class, 'restore'])->name('papelera.restore');
    
});