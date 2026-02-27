<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelEstudio extends Model
{
    protected $table = 'niveles_estudio';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;


    // Relación con casos de género
    public function casosGenero()
    {
        return $this->hasMany(DireccionGeneroCaso::class, 'nivel_estudio_id');
    }
}