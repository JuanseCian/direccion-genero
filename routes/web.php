<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::middleware('auth')->get('/home', function () {
    return 'Login funcionando ✔';
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//panel de admin
Route::middleware(['auth','admin'])->group(function () {

    Route::view('/admin/panel', 'admin.panel')->name('admin.panel');

});

//busqueda
Route::get('/buscar', function(){
    return "busqueda";
})->name('buscar')->middleware('auth');

require __DIR__.'/auth.php';
//rutas home
require __DIR__.'/home.php';
//rutas manuales
require __DIR__.'/manuales.php';
//rutas admin
require __DIR__.'/admin.php';
//rutas genero
require __DIR__.'/genero.php';
//rutas masculinidades
require __DIR__.'/masculinidades.php';
//rutas ive
require __DIR__.'/ive.php';
//rutas personas
require __DIR__.'/personas.php';


//Rutas de Back/para admin
//rutas barrio
require __DIR__.'/barrio.php';
//rutas localidad
require __DIR__.'/localidades.php';
//rutas zona barrio
require __DIR__.'/zonas.php';