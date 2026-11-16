<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function normalizarBusqueda(?string $buscar): string
    {
        $buscar = mb_strtolower(trim((string) $buscar), 'UTF-8');

        return preg_replace('/[\s,.\-]+/u', '', $buscar) ?? '';
    }

    protected function filtrarPorPersona($query, string $buscar)
    {
        $like = "%{$buscar}%";
        $nombre = "LOWER(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT(COALESCE(apellido, ''), COALESCE(nombre, '')), ',', ''), ' ', ''), '.', ''), '-', ''))";
        $nombreInverso = "LOWER(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT(COALESCE(nombre, ''), COALESCE(apellido, '')), ',', ''), ' ', ''), '.', ''), '-', ''))";
        $dni = "LOWER(REPLACE(REPLACE(REPLACE(REPLACE(COALESCE(dni, ''), '.', ''), '-', ''), ' ', ''), ',', ''))";

        return $query->whereHas('persona', function ($personaQuery) use ($like, $nombre, $nombreInverso, $dni) {
            $personaQuery->where(function ($query) use ($like, $nombre, $nombreInverso, $dni) {
                $query->whereRaw("{$nombre} LIKE ?", [$like])
                    ->orWhereRaw("{$nombreInverso} LIKE ?", [$like])
                    ->orWhereRaw("{$dni} LIKE ?", [$like]);
            });
        });
    }
}
