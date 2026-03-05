<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\DireccionGeneroIntervencion;
use Illuminate\Http\Request;

class DireccionGeneroIntervencionController extends Controller
{
    public function store(Request $request, $casoId)
    {
        $request->validate([
            'fecha_intervencion'  => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
        ]);

        DireccionGeneroIntervencion::create([
            'caso_id'              => $casoId,
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        return redirect()->back()->with('success', 'Intervención registrada correctamente.');
    }
}