<?php

use App\Http\Controllers\Admin\AdminUserController;

Route::middleware(['auth','activo','admin'])->group(function () {

Route::get('/admin/users',
[AdminUserController::class,'index'])
->name('admin.users.index');


Route::get('/admin/users/{id}/edit',
[AdminUserController::class,'edit'])
->name('admin.users.edit');


Route::put('/admin/users/{id}',
[AdminUserController::class,'update'])
->name('admin.users.update');

});

Route::get('/admin', function(){
    return view('admin.panel');
})->name('admin.panel');

