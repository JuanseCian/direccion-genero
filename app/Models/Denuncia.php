<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    protected $fillable = [
        'fecha',
        'atendido_por',
        'denunciante',
        'dni',
        'telefono',
        'direccion',
        'barrio',
        'agresor',
        'tipo_violencia',
        'observaciones'
    ];

    public function scopeForDni(Builder $query, ?string $dni): Builder
    {
        $dniNormalizado = preg_replace('/\D+/', '', (string) $dni);

        if ($dniNormalizado === '') {
            return $query->whereRaw('1 = 0');
        }

        return $query
            ->whereNotNull('dni')
            ->whereRaw(
                "REPLACE(REPLACE(REPLACE(dni, '.', ''), '-', ''), ' ', '') = ?",
                [$dniNormalizado]
            )
            ->orderByDesc('fecha');
    }
}
