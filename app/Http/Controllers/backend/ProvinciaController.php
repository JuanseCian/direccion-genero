<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index() {
        $provincias = Provincia::orderBy('nombre')->get();
        return view('backend.provincias.index', compact('provincias'));
    }

    public function create() {
        return view('backend.provincias.create');
    }

    public function store(Request $request) {
        $request->validate(['nombre' => 'required|unique:provincia,nombre']);
        Provincia::create($request->all());
        return redirect()->route('provincias.index')->with('success', 'Provincia creada.');
    }

    public function edit($id) {
        $provincia = Provincia::findOrFail($id);
        return view('backend.provincias.edit', compact('provincia'));
    }

    public function update(Request $request, $id) {
        $request->validate(['nombre' => 'required|unique:provincia,nombre,'.$id]);
        $provincia = Provincia::findOrFail($id);
        $provincia->update($request->all());
        return redirect()->route('provincias.index')->with('success', 'Provincia actualizada.');
    }

    public function destroy($id) {
        Provincia::findOrFail($id)->delete();
        return redirect()->route('provincias.index')
                        ->with('deleted', 'Provincia eliminada.');
    }
}