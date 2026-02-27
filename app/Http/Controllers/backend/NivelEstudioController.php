<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NivelEstudio;
use Illuminate\Http\Request;

class NivelEstudioController extends Controller
{
    public function index() {
        $niveles = NivelEstudio::all();
        return view('backend.nivel-estudio.index', compact('niveles'));
    }

    public function create() {
        return view('backend.nivel-estudio.create');
    }

    public function store(Request $request) {
        $request->validate(['nombre' => 'required|unique:niveles_estudio,nombre|max:255']);
        NivelEstudio::create($request->all());
        return redirect()->route('backend.nivel-estudio.index')->with('success', 'Nivel de estudio creado.');
    }

    public function edit($id) {
        $nivelEstudio = NivelEstudio::findOrFail($id);
        return view('backend.nivel-estudio.edit', compact('nivelEstudio'));
    }

    public function update(Request $request, $id) {
        $nivelEstudio = NivelEstudio::findOrFail($id);
        $request->validate(['nombre' => 'required|max:255|unique:niveles_estudio,nombre,'.$id]);
        $nivelEstudio->update($request->all());
        return redirect()->route('backend.nivel-estudio.index')->with('success', 'Actualizado correctamente.');
    }

    public function destroy($id) {
        NivelEstudio::findOrFail($id)->delete();
        return redirect()->route('backend.nivel-estudio.index')->with('success', 'Eliminado correctamente.');
    }
}