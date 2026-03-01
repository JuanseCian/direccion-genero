<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasculinidadesCaso extends Model
{
    use HasFactory;

    protected $table = 'masculinidades_casos';
    
    protected $fillable = [
        'persona_id', 'victima_id', 'derivacion_id', 'situacion_habitacional_id',
        'nivel_estudio_id', 'trabaja', 'red_contencion', 'situacion_sanitaria_id',
        'realiza_tratamiento', 'consumo', 'terapia', 'espacio_grupal_id',
        'hijos_en_comun', 'relacion_actual', 'descripcion_relacion',
        'situacion_judicial', 'desobediencia', 'reincidencia',
        'asistencia_dispositivo', 'observaciones', 'encargado_id'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class);
    }

    
}
