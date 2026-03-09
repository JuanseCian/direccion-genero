<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasculinidadesGrupoFamiliar extends Model
{
    use HasFactory;
    protected $table = 'masculinidades_grupo_familiar';

    public $timestamps = false;
    
    protected $fillable = [
        'caso_id',
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'vinculo_actual'
    ];
    
    public function caso()
    {
        return $this->belongsTo(MasculinidadesCaso::class, 'caso_id');
    }
}
