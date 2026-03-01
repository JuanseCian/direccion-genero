<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IveCaso extends Model
{
    use HasFactory;
    protected $fillable = [
        'persona_id', 'fum', 'eco_semanas', 'obra_social', 'cantidad_hijos', 'interrupcion_previa', 'alta', 'encargado_id'
    ];

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
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
}
