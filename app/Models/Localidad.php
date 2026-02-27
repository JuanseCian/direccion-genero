<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidad';
    
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'codigo_postal',
        'provincia_id'
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
}
