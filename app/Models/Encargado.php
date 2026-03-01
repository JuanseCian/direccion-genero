<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $table = 'encargados';

    protected $fillable = [
        'nombre',
        'apellido'
    ];

    public function areas()
    {
        return $this->belongsToMany(
            Area::class,
            'encargado_area',   
            'encargado_id',   
            'area_id'         
        );
    }
}