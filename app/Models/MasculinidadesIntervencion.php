<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Adjunto;

class MasculinidadesIntervencion extends Model
{
    protected $table = 'masculinidades_intervenciones';
    
    protected $fillable = [
        'caso_id',
        'fecha_intervencion',
        'tipo_intervencion_id',
        'encargado_id',
        'detalle'
    ];

    public function tipo() {
        return $this->belongsTo(TipoIntervencion::class, 'tipo_intervencion_id');
    }

    public function encargado() {
        // Apuntamos a Encargado porque es lo que usas en Masculinidades
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }
    public function adjunto()
{
    return $this->hasOne(Adjunto::class, 'entidad_id')
        ->where('entidad_tipo', 'intervencion_masculinidades');
}

    public function caso()
    {
        return $this->belongsTo(MasculinidadesCaso::class, 'caso_id');
    }
}