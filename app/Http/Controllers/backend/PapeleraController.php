<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\IveCaso;
use App\Models\DireccionGeneroCaso;
use App\Models\MasculinidadesCaso; // Asegúrate que el modelo se llame así
use Illuminate\Http\Request;

class PapeleraController extends Controller
{
    public function index()
    {
        $fechaLimite = now()->subDays(30);

        // Cargamos todos los registros eliminados con sus relaciones
        $ive = IveCaso::onlyTrashed()
            ->where('deleted_at', '>=', $fechaLimite)
            ->with(['persona', 'eliminador'])
            ->get();

        $genero = DireccionGeneroCaso::onlyTrashed()
            ->where('deleted_at', '>=', $fechaLimite)
            ->with(['persona', 'eliminador'])
            ->get();

        $masculinidades = MasculinidadesCaso::onlyTrashed()
            ->with(['persona', 'eliminador']) 
            ->where('deleted_at', '>=', now()->subDays(30))
            ->get();

        // Enviamos las 3 variables a la vista
        return view('backend.papelera.index', compact('ive', 'genero', 'masculinidades'));
    }

    public function restore($tipo, $id)
    {
        $modelo = $this->getModelo($tipo);
        $registro = $modelo::withTrashed()->findOrFail($id);
        
        // Limpiamos los campos de eliminación al restaurar (opcional pero recomendado)
        $registro->deleted_by = null;
        $registro->motivo_eliminacion = null;
        $registro->save();

        $registro->restore();

        return redirect()->back()->with('success', 'El caso ha sido restaurado exitosamente.');
    }

    private function getModelo($tipo)
    {
        return match($tipo) {
            'ive' => \App\Models\IveCaso::class,
            'genero' => \App\Models\DireccionGeneroCaso::class,
            'masculinidades' => \App\Models\MasculinidadesCaso::class, // <-- Verifica si es Masculinidad o Masculinidades
            default => abort(404),
        };
    }
}