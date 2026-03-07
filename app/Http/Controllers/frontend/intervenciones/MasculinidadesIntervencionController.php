<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\MasculinidadesIntervencion;
use Illuminate\Http\Request;

class MasculinidadesIntervencionController extends Controller
{
    public function store(Request $request, $casoId)
    {
        $request->validate([
            'fecha_intervencion' => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id' => 'required|exists:encargados,id',
            'detalle' => 'required|string',
        ]);

        MasculinidadesIntervencion::create([
            'caso_id' => $casoId,
            'fecha_intervencion' => $request->fecha_intervencion,
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'encargado_id' => $request->encargado_id,
            'detalle' => $request->detalle,
        ]);

        return redirect()->back()->with('success', 'Intervención registrada correctamente.');
    }
}