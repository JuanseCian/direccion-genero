<?php

namespace App\Http\Controllers\frontend\intervenciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DireccionGeneroIntervencion;
use App\Models\DireccionGeneroCaso;
use App\Models\Encargado;
use App\Models\TipoIntervencion;

class DireccionGeneroIntervencionController extends Controller
{
    public function create($casoId)
    {
        $legajo = DireccionGeneroCaso::with('persona')->findOrFail($casoId);

        $encargados = Encargado::orderBy('apellido')->get();
        $tiposIntervencion = TipoIntervencion::orderBy('nombre')->get();

        return view('frontend.areas.genero.intervenciones.create', compact(
            'legajo',
            'encargados',
            'tiposIntervencion'
        ));
    }

    public function store(Request $request, $casoId)
    {
        $request->validate([
            'fecha_intervencion'   => 'required|date',
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

        return redirect()
            ->route('genero.edit', $casoId)
            ->with('success', 'Intervención registrada correctamente.');
    }

    public function edit($id)
    {
        $intervencion = DireccionGeneroIntervencion::findOrFail($id);

        $encargados = \App\Models\Encargado::orderBy('apellido')->get();
        $tiposIntervencion = \App\Models\TipoIntervencion::orderBy('nombre')->get();

        return view('frontend.areas.genero.intervenciones.edit', compact(
            'intervencion',
            'encargados',
            'tiposIntervencion'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_intervencion'   => 'required|date',
            'tipo_intervencion_id' => 'required|exists:tipos_intervencion,id',
            'encargado_id'         => 'required|exists:encargados,id',
            'detalle'              => 'required|string',
        ]);

        $intervencion = DireccionGeneroIntervencion::findOrFail($id);

        $intervencion->update([
            'tipo_intervencion_id' => $request->tipo_intervencion_id,
            'fecha_intervencion'   => $request->fecha_intervencion,
            'detalle'              => $request->detalle,
            'encargado_id'         => $request->encargado_id,
        ]);

        return redirect()
            ->route('genero.edit', $intervencion->caso_id)
            ->with('success', 'Intervención actualizada correctamente.');
    }
}