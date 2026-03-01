<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioGrupal extends Model
{
    use HasFactory;

    protected $table = 'espacios_grupales'; 
    public $timestamps = false; 

    protected $fillable = ['nombre']; 

    public function casos()
    {
        return $this->hasMany(MasculinidadesCaso::class, 'espacio_grupal_id');
    }
}