<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    protected $fillable = [
        'fecha',
        'atendido_por',
        'denunciante',
        'dni',
        'telefono',
        'direccion',
        'barrio',
        'agresor',
        'tipo_violencia',
        'observaciones'
    ];
}