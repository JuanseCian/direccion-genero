<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\EspacioGrupal; // Basado en la tabla espacios_grupales
use Illuminate\Http\Request;

class EspacioGrupalController extends Controller
{
    public function index()
    {
        // Trae Club, Agrupacion, Religion, etc.
        $espacios = EspacioGrupal::all();
        return view('backend.espacios-grupales.index', compact('espacios'));
    }

    public function create()
    {
        return view('backend.espacios-grupales.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:espacios_grupales,nombre|max:100'
        ]);

        EspacioGrupal::create($request->all());
        return redirect()->route('espacios-grupales.index')->with('success', 'Espacio grupal creado.');
    }

    public function edit($id)
    {
        $espacio = EspacioGrupal::findOrFail($id);
        return view('backend.espacios-grupales.edit', compact('espacio'));
    }

    public function update(Request $request, $id)
    {
        $espacio = EspacioGrupal::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:100|unique:espacios_grupales,nombre,'.$id
        ]);

        $espacio->update($request->all());
        return redirect()->route('espacios-grupales.index')->with('success', 'Espacio actualizado.');
    }

    public function destroy($id)
    {
        // Nota: La tabla masculinidades_casos tiene una FK a esta tabla
        $espacio = EspacioGrupal::findOrFail($id);

        $espacio->delete();

        try {
            EspacioGrupal::destroy($id);
            return redirect()->route('espacios-grupales.index')->with('success', 'Espacio eliminado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('deleted', 'No se puede eliminar porque está asignado a un legajo.');
        }
    }
}