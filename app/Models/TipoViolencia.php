<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoViolencia extends Model
{
    use HasFactory;

    protected $table = 'tipos_violencia';
    
    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
