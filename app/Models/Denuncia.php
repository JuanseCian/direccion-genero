<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $fillable = [
        'persona_id',
        'agresor_id',
        'fecha',
        'descripcion',
        'tipo_violencia',
        'lugar',
        'requiere_intervencion'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function agresor()
    {
        return $this->belongsTo(Persona::class, 'agresor_id');
    }
}
