<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $fillable = [
        'fecha',
        'atendio_nombre',
        'atendio_apellido',
        'nombre',
        'apellido',
        'dni',
        'direccion',
        'barrio',
        'telefono',
        'agresor',
        'tipo_violencia',
        'observaciones'
    ];
}
