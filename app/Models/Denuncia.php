<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'edad',
        'telefono',
        'direccion',
        'barrio',
        'agresor',
        'tipo_violencia',
        'tipo_amenaza',
        'observaciones'
    ];

    protected function atendidoPor(): Attribute
    {
        return $this->nombreEnMayusculas();
    }

    protected function denunciante(): Attribute
    {
        return $this->nombreEnMayusculas();
    }

    protected function agresor(): Attribute
    {
        return $this->nombreEnMayusculas();
    }

    private function nombreEnMayusculas(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value === null ? null : mb_strtoupper($value, 'UTF-8'),
            set: fn (?string $value) => $value === null ? null : mb_strtoupper(trim($value), 'UTF-8'),
        );
    }

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
            ->orderByDesc('created_at')
            ->orderByDesc('id');
    }
}
