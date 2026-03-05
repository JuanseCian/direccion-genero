<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use App\Models\IveIntervencion;
use Illuminate\Http\Request;

class IveIntervencionController extends Controller
{
    /**
     * Guarda una nueva intervención para un caso de IVE.
     */
    public function store(Request $request, $casoId)
    {
        $request->validate([
            'fecha_intervencion'  => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
        ]);

        try {
            IveIntervencion::create([
                'ive_caso_id'          => $casoId,
                'tipo_intervencion_id' => $request->tipo_intervencion_id,
                'fecha_intervencion'   => $request->fecha_intervencion,
                'detalle'              => $request->detalle,
                'encargado_id'         => $request->encargado_id,
            ]);

            return redirect()->back()->with('success', 'Intervención registrada correctamente.');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'No se pudo registrar la intervención: ' . $e->getMessage()])
                ->withInput();
        }
    }
}