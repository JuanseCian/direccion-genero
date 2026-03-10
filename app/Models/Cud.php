<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cud extends Model
{
    protected $table = 'cud';

    public $timestamps = false;

    protected $fillable = [
        'persona_id',
        'tiene_cud',
        'numero_cud',
        'fecha_emision',
        'fecha_vencimiento',
        'observaciones'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}