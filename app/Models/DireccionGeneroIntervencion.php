<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DireccionGeneroIntervencion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'direccion_genero_intervenciones';

    protected $fillable = [
        'caso_id',
        'tipo_intervencion_id',
        'fecha_intervencion',
        'detalle',
        'encargado_id',
        'deleted_by',
        'motivo_eliminacion',
    ];

    protected $casts = [
        'fecha_intervencion' => 'date',
    ];

    public function caso()
    {
        return $this->belongsTo(
            DireccionGeneroCaso::class,
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
            'intervencion_genero'
        );
    }
}
