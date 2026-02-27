<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProvinciaController;

Route::resource('provincias', ProvinciaController::class);