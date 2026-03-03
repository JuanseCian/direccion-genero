<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{

    protected $table = 'barrio';

    protected $fillable = [
        'nombre',
        'localidad_id',
        'zona_barrio_id'
    ];

    public $timestamps = false;

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }
    
    public function zona()
    {
        return $this->belongsTo(ZonaBarrio::class,'zona_barrio_id');
    }

}