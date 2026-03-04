<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\EstadoCivil;
use App\Models\NivelEstudio;
use App\Models\Provincia;
use App\Models\Localidad;
use App\Models\Barrio;

class DireccionGeneroCaso extends Model
{
    protected $table = 'direccion_genero_casos';

    protected $fillable = [

        'persona_id',
        'estado_civil_id',
        'genero',

        'provincia_id',
        'localidad_id',
        'barrio_id',

        'nivel_estudio_id',

        'trabaja',

        'organizacion_social',
        'organizacion_social_detalle',

        'encargado_id',

        'observaciones'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }


    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class,'estado_civil_id');
    }


    public function nivelEstudio()
    {
        return $this->belongsTo(NivelEstudio::class,'nivel_estudio_id');
    }


    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }


    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }


    public function barrio()
    {
        return $this->belongsTo(Barrio::class);
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class,'encargado_id');
    }

    public function agresores()
    {
        return $this->belongsToMany(
            \App\Models\MasculinidadesCaso::class, 
            'vinculos_casos',                  
            'genero_caso_id',                   
            'masculinidad_caso_id'               
        )->withPivot('tipo_vinculo');            
}



}