<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estados_civiles';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;


    // Relación con casos de género
    public function casosGenero()
    {
        return $this->hasMany(DireccionGeneroCaso::class, 'estado_civil_id');
    }
}