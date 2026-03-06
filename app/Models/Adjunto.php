<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;

    protected $table = 'adjuntos';

    protected $fillable = [
        'entidad_tipo',
        'entidad_id',
        'nombre_original',
        'nombre_guardado',
        'ruta',
        'tipo_mime',
        'tamaño',
        'hash_sha256',
        'subido_por',
        'confidencial'
    ];
     public $timestamps = false;
    protected $casts = [
        'confidencial' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'subido_por');
    }

    public function entidad()
    {
        return $this->morphTo(null, 'entidad_tipo', 'entidad_id');
    }

    public function url()
    {
        return asset('storage/'.$this->ruta);
    }

    public function tamañoLegible()
    {
        $bytes = $this->tamaño;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2).' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' bytes';
    }
}