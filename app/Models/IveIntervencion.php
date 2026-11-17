<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Adjunto;
class IveIntervencion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ive_intervenciones';

    protected $fillable = [
        'ive_caso_id',
        'tipo_intervencion_id',
        'fecha_intervencion',
        'detalle',
        'encargado_id',
        'deleted_by',
        'motivo_eliminacion',
    ];

    public function caso() {
        return $this->belongsTo(IveCaso::class, 'ive_caso_id');
    }

    public function tipo() {
        return $this->belongsTo(TipoIntervencion::class, 'tipo_intervencion_id');
    }
    public function adjuntos()
    {
        return $this->hasMany(
            Adjunto::class,
            'entidad_id',
            'id'
        )->where(
            'entidad_tipo',
            'intervencion_ive'
        );
    }
    public function encargado() {
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }

    public function interventions() {
        return $this->hasMany(IveIntervencion::class, 'ive_caso_id')->orderBy('fecha_intervencion', 'desc');
    }
}
