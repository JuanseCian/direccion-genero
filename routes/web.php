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

Route::middleware(['auth','activo'])->get('/home', function () {
    return 'Login funcionando ✔';
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','activo','verified'])->name('dashboard');

Route::middleware(['auth','activo'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//panel de admin
Route::middleware(['auth','activo','admin'])->group(function () {

    Route::view('/admin/panel', 'admin.panel')->name('admin.panel');

});

//busqueda
Route::get('/buscar', function(){
    return "busqueda";
})->name('buscar')->middleware(['auth','activo']);

require __DIR__.'/auth.php';

//Rutas de Front/para usuarios comunes o administradores
//rutas home
require __DIR__.'/home.php';
//rutas manuales
require __DIR__.'/manuales.php';
//rutas admin
require __DIR__.'/admin.php';
//rutas genero
require __DIR__.'/genero.php';
//rutas masculinidades
Route::middleware(['auth','activo','area:direccion_genero'])->group(function () {

    require __DIR__.'/genero.php';
    require __DIR__.'/masculinidades.php';

});
//rutas ive
Route::middleware(['auth','activo','area:ive'])->group(function () {

    require __DIR__.'/ive.php';

});
//rutas personas
require __DIR__.'/personas.php';



//Rutas de Back/para administradores
//rutas barrio
require __DIR__.'/barrio.php';
//rutas localidad
require __DIR__.'/localidades.php';
//rutas zona barrio
require __DIR__.'/zonas.php';
//rutas provincia
require __DIR__.'/provincia.php';
//rutas estado civil
require __DIR__.'/estado-civil.php';
//rutas nivel estudio
require __DIR__.'/nivel-estudio.php';
//rutas encargado
require __DIR__.'/encargado.php';
//rutas espacios grupales
require __DIR__.'/espaciogrupal.php';