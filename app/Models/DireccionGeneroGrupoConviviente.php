<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionGeneroGrupoConviviente extends Model
{
    protected $table = 'direccion_genero_grupo_conviviente';

    protected $fillable = [
        'caso_id',
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'vinculo'
    ];

    public $timestamps = false;

    public function caso()
    {
        return $this->belongsTo(DireccionGeneroCaso::class, 'caso_id');
    }
}