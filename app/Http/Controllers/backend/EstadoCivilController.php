<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function index() {
        $estados = EstadoCivil::all();
        return view('backend.estado-civil.index', compact('estados'));
    }

    public function create()
    {
        return view('backend.estado-civil.create');
    }

    public function store(Request $request) {
        $request->validate(['nombre' => 'required|unique:estados_civiles|max:255']);
        EstadoCivil::create($request->all());
        return redirect()->route('backend.estado-civil.index')
                         ->with('success', 'Guardado con éxito');
    }
        
    public function edit(EstadoCivil $estadoCivil)
    {
        return view('backend.estado-civil.edit', compact('estadoCivil'));
    }

    public function update(Request $request, EstadoCivil $estadoCivil) {
        $request->validate(['nombre' => 'required|max:255']);
        $estadoCivil->update($request->all());
        return redirect()->route('backend.estado-civil.index')
                         ->with('success', 'Actualizado con éxito');
    }

    public function destroy(EstadoCivil $estadoCivil) {
        $estadoCivil->delete();
        return redirect()->back()->with('success', 'Registro eliminado');
    }
}
