<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\EstadoCivil;
use App\Models\NivelEstudio;
use App\Models\Provincia;
use App\Models\Localidad;
use App\Models\Barrio;
use App\Models\MedidaCautelar;
use App\Models\SituacionHabitacional;
use App\Models\SituacionSanitaria;
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
        'debe_asistir_masculinidades',
        'medida_cautelar_id',
        'observaciones',
        'encargado_id',
        'agresor_id',
        'agresor_trabajo',
        'servicios_luz',
        'servicios_cable',
        'servicios_gas_natural',
        'denuncio_antes',
        'denuncio_antes_detalle',
        'amenaza_con_arma',
        'fecha_ultima_denuncia',
        'amenaza_tipo_arma',
        'tipo_violencia_id',
        'boton_panico_numero',
        'servicios_agua_potable',
        'servicios_internet',
        'situacion_habitacional_id'
    ];
    protected $casts = [
        'debe_asistir_masculinidades' => 'boolean',
    ];

    public function tipoViolencia()
    {
        return $this->belongsTo(TipoViolencia::class, 'tipo_violencia_id');
    }

    public function medidaCautelar()
    {
        return $this->belongsTo(medidaCautelar::class);
    }

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
        )->withPivot([
            'hijos_en_comun',
            'relacion_actual',
            'descripcion_relacion',
            'tipo_vinculo',
            'observaciones',
            'fecha_vinculacion'
        ]);
    }

    public function intervenciones()
    {
        return $this->hasMany(DireccionGeneroIntervencion::class, 'caso_id')->orderBy('fecha_intervencion', 'desc');
    }


}