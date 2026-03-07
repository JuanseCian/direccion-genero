<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MedidaCautelar;

class MasculinidadesCaso extends Model
{
    use HasFactory;

    protected $table = 'masculinidades_casos';
    
    protected $fillable = [
        'persona_id',
        'victima_id',
        'derivacion_id',
        'situacion_habitacional_id',
        'nivel_estudio_id',
        'trabaja',
        'detalle_trabajo',
        'red_contencion',
        'situacion_sanitaria_id',
        'realiza_tratamiento',
        'consumo',
        'terapia',
        'espacio_grupal_id',
        'hijos_en_comun',
        'relacion_actual',
        'tipo_relacion',
        'descripcion_relacion',
        'situacion_judicial',
        'desobediencia',
        'reincidencia',
        'asistencia_dispositivo',
        'observaciones',
        'encargado_id',
        'debe_dispositivo',
        'asistencia_dispositivo',
        'fecha_fin_dispositivo'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class);
    }
    public function situacion()
    {
        return $this->belongsTo(SituacionSanitaria::class);
    }
    public function medidas()
    {
        return $this->belongsToMany(
            MedidaCautelar::class,
            'masculinidades_caso_medida',
            'caso_id',
            'medida_id'
        );
    }
    public function grupoFamiliar()
    {
        return $this->hasMany(MasculinidadesGrupoFamiliar::class, 'caso_id');
    }
    public function espacioGrupal()
    {
        return $this->belongsTo(EspacioGrupal::class, 'espacio_grupal_id');
    }
    public function tiposViolencia()
    {
        return $this->belongsToMany(
            TipoViolencia::class,
            'masculinidades_caso_violencia',
            'caso_id',
            'tipo_violencia_id'
        );
    }

    public function victimas()
    {
        return $this->belongsToMany(
            DireccionGeneroCaso::class,
            'vinculos_casos',
            'masculinidad_caso_id',
            'genero_caso_id'
        )->withPivot([
            'hijos_en_comun',
            'relacion_actual',
            'descripcion_relacion',
            'tipo_vinculo',
            'observaciones',
            'fecha_vinculacion'
        ]);
    }

    public function intervenciones() {
        return $this->hasMany(MasculinidadesIntervencion::class, 'caso_id')
                    ->orderBy('fecha_intervencion', 'desc');
    }
    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class, 'entidad_id')
            ->where('entidad_tipo', 'masculinidades');
    }
}
