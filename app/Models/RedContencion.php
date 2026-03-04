<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedContencion extends Model
{
    protected $table = 'red_contencion';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function casos()
{
    return $this->belongsToMany(
        \App\Models\IveCaso::class,
        'ive_caso_red',
        'red_id',
        'ive_caso_id'
    );
}
}