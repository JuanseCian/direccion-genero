<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaBarrio extends Model
{
    protected $table = 'zona_barrio'; // IMPORTANTE

    protected $fillable = [
        'nombre'
    ];
}
