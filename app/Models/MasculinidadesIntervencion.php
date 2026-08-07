<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasculinidadesIntervencion extends Model
{
    use HasFactory;

    protected $table = 'masculinidades_intervenciones';

    protected $fillable = [
        'caso_id',
        'fecha_intervencion',
        'tipo_intervencion_id',
        'encargado_id',
        'detalle',
    ];

    protected $casts = [
        'fecha_intervencion' => 'date',
    ];

    public function caso()
    {
        return $this->belongsTo(
            MasculinidadesCaso::class,
            'caso_id'
        );
    }

    public function tipo()
    {
        return $this->belongsTo(
            TipoIntervencion::class,
            'tipo_intervencion_id'
        );
    }

    public function encargado()
    {
        return $this->belongsTo(
            Encargado::class,
            'encargado_id'
        );
    }

    public function adjuntos()
    {
        return $this->hasMany(
            Adjunto::class,
            'entidad_id',
            'id'
        )->where(
            'entidad_tipo',
            'intervencion_masculinidades'
        );
    }
}