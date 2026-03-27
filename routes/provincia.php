<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ProvinciaController;

Route::resource('provincias', ProvinciaController::class);