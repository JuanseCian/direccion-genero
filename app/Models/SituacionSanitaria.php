<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacionSanitaria extends Model
{
    use HasFactory;

    protected $table = 'situaciones_sanitarias';
    
    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
