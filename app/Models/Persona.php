<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
    'nombre',
    'apellido',
    'dni',
    'telefono',
    'domicilio',
    'fecha_nacimiento',
    'barrio_id',
    'trabaja',
    'grupo_sanguineo'
    ];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class);
    }
}
