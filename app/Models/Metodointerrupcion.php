<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoInterrupcion extends Model
{
    use HasFactory;

    protected $table = 'metodos_interrupcion';

    protected $fillable = [
        'nombre'
    ];

    public function casos()
    {
        return $this->hasMany(IveCaso::class,'metodo_interrupcion_id');
    }
}

