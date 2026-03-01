<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MedidaCautelar;
use Illuminate\Http\Request;

class MedidaCautelarController extends Controller
{
    public function index()
    {
        $medidas = MedidaCautelar::all();
        return view('backend.medidas-cautelares.index', compact('medidas'));
    }

    public function create()
    {
        return view('backend.medidas-cautelares.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:medidas_cautelares,nombre|max:150'
        ]);

        MedidaCautelar::create($request->all());
        return redirect()->route('medidas-cautelares.index')->with('success', 'Medida creada correctamente.');
    }

    public function edit($id)
    {
        $medida = MedidaCautelar::findOrFail($id);
        return view('backend.medidas-cautelares.edit', compact('medida'));
    }

    public function update(Request $request, $id)
    {
        $medida = MedidaCautelar::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:150|unique:medidas_cautelares,nombre,'.$id
        ]);

        $medida->update($request->all());
        return redirect()->route('medidas-cautelares.index')->with('success', 'Medida actualizada.');
    }

    public function destroy($id)
    {
        MedidaCautelar::destroy($id);
        return redirect()->route('medidas-cautelares.index')->with('success', 'Medida eliminada.');
    }
}