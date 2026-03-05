<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionGeneroIntervencion extends Model
{
    protected $table = 'direccion_genero_intervenciones';

    protected $fillable = [
        'caso_id',
        'tipo_intervencion_id',
        'fecha_intervencion',
        'detalle',
        'encargado_id'
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoIntervencion::class, 'tipo_intervencion_id');
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }
}