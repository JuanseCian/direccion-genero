<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIntervencion extends Model
{
    use HasFactory;

    protected $table = 'tipos_intervencion';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;

    public function intervencionesIve()
    {
        return $this->hasMany(IveIntervencion::class, 'tipo_intervencion_id');
    }

    
    public function intervencionesMasculinidades()
    {
        return $this->hasMany(MasculinidadesIntervencion::class, 'tipo_intervencion_id');
    }

    
    public function intervencionesGenero()
    {
        return $this->hasMany(DireccionGeneroIntervencion::class, 'tipo_intervencion_id');
    }
}