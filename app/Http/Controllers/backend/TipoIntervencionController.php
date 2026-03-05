<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TipoIntervencion;
use Illuminate\Http\Request;

class TipoIntervencionController extends Controller
{
    public function index()
    {
        $tipos = TipoIntervencion::orderBy('nombre')->get();
        return view('backend.tipo-intervencion.index', compact('tipos'));
    }

    public function create()
    {
        return view('backend.tipo-intervencion.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:tipos_intervencion,nombre|max:150']);
        TipoIntervencion::create($request->all());
        return redirect()->route('backend.tipo-intervencion.index')
                     ->with('success', 'Tipo de intervención creado correctamente.');

    }

    public function edit($id)
    {
        $tipo = TipoIntervencion::findOrFail($id);
        return view('backend.tipo-intervencion.edit', compact('tipo'));
    }

    public function update(Request $request, TipoIntervencion $tipoIntervencion)
    {
        $request->validate(['nombre' => 'required|max:150|unique:tipos_intervencion,nombre,'.$tipoIntervencion->id]);
        $tipoIntervencion->update($request->all());
        return redirect()->route('backend.tipo-intervencion.index')
                     ->with('success', 'Tipo de intervención creado correctamente.');

    }

    public function destroy(TipoIntervencion $tipoIntervencion)
    {
        try {
            $tipoIntervencion->delete();
            return redirect()->back()->with('success', 'Eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se puede eliminar porque está en uso en intervenciones existentes.');
        }
    }
}