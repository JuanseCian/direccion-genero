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
    'agresor',
    'debe_asistir_masculinidades'
    ];

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

    public function casosMasculinidades()
        {
        return $this->hasMany(\App\Models\MasculinidadesCaso::class, 'persona_id');
    }

    public function barrios()
    {
        return $this->belongsTo(\App\Models\Barrio::class);
    }

    public function cud()
    {
        return $this->hasOne(Cud::class);
    }

    public function denuncias()
    {
        return $this->hasMany(Denuncia::class, 'dni', 'dni')
            ->whereNotNull('dni')
            ->orderByDesc('fecha');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }
}
