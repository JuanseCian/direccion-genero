<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaBarrio extends Model
{
    protected $table = 'zona_barrio';

    protected $fillable = [
        'nombre'
    ];

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'zona_barrio_id');
    }
}
