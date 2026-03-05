<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IveIntervencion extends Model
{
    use HasFactory;

    protected $table = 'ive_intervenciones';

    protected $fillable = [
        'ive_caso_id',
        'tipo_intervencion_id',
        'fecha_intervencion',
        'detalle',
        'encargado_id'
    ];

    public function caso() {
        return $this->belongsTo(IveCaso::class, 'ive_caso_id');
    }

    public function tipo() {
        return $this->belongsTo(TipoIntervencion::class, 'tipo_intervencion_id');
    }

    public function encargado() {
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }

    public function interventions() {
        return $this->hasMany(IveIntervencion::class, 'ive_caso_id')->orderBy('fecha_intervencion', 'desc');
    }
}