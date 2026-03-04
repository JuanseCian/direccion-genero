<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IveMedicacion extends Model
{
    protected $table = 'ive_medicaciones';
    public $timestamps = false;
    protected $fillable = [
        'ive_caso_id',
        'nombre',
        'numero_lote'
    ];

    public function caso()
    {
        return $this->belongsTo(IveCaso::class, 'ive_caso_id');
    }
}