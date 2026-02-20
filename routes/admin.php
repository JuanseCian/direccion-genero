<?php

Route::get('/admin', function(){
    return view('backend.admin.panel');
})->name('admin.panel');