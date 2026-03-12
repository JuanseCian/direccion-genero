<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RedContencion;
use App\Models\Encargado;

class IveCaso extends Model
{
    use HasFactory;
    protected $fillable = [
        'persona_id',
        'fum',
        'eco_semanas',
        'semanas_gestacion',
        'estado_civil_id',
        'metodo_interrupcion_id',
        'obra_social',
        'cantidad_hijos',
        'interrupcion_previa',
        'alta',
        'encargado_id'
    ];

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function tiposViolencia()
    {
        return $this->belongsToMany(
            TipoViolencia::class,
            'ive_caso_violencia',
            'ive_caso_id',
            'tipo_violencia_id'
        );
    }

    public function redesContencion()
    {
        return $this->belongsToMany(
            \App\Models\RedContencion::class,
            'ive_caso_red',
            'ive_caso_id',
            'red_id'
        );
    }

    public function areas()
    {
        return $this->belongsToMany(
            Area::class,
            'encargado_area',
            'encargado_id',
            'area_id'
        );
    }

    public function medicaciones()
    {
        return $this->hasMany(IveMedicacion::class, 'ive_caso_id');
    }

    public function intervenciones()
    {
        return $this->hasMany(IveIntervencion::class, 'ive_caso_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class,'estado_civil_id');
    }

    public function metodoInterrupcion()
    {
        return $this->belongsTo(MetodoInterrupcion::class,'metodo_interrupcion_id');
    }
    public function encargado()
{
    return $this->belongsTo(Encargado::class);
}
}
