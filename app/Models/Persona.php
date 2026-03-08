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
    'sexo',
    'telefono',
    'domicilio',
    'fecha_nacimiento',
    'barrio_id',
    'trabaja',
    'nivel_estudio_id',
    'localidad_id',
    'provincia_id',
    'grupo_sanguineo',
    'victima',
    'agresor'
    ];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class);
    }
    public function casosAgresor()
{
    return $this->hasMany(DireccionGeneroCaso::class,'agresor_id');
}
    public function casosIve() {
        return $this->hasMany(IveCaso::class, 'persona_id');
    }

    public function casosGenero() {
        return $this->hasMany(DireccionGeneroCaso::class, 'persona_id');
    }
    
    public function masculinidadesCasos()
    {
        return $this->hasMany(\App\Models\MasculinidadesCaso::class);
    }

    public function barrios()
    {
        return $this->belongsTo(\App\Models\Barrio::class);
    }

}
