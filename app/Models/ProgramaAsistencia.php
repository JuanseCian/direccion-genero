<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaAsistencia extends Model
{
    protected $table = 'programas_asistencia';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}