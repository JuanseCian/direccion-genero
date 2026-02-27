<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Localidad;

class LocalidadController extends Controller
{

    public function index()
    {
        $localidades = Localidad::orderBy('nombre')->get();

        return view('backend.localidades.index',
            compact('localidades'));
    }


    public function create()
    {
        $provincias = Provincia::all();
        return view('backend.localidades.create', compact('provincias'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'codigo_postal'=>'required',
            'provincia_id'=>'required'
        ]);

        Localidad::create($request->all());

        return redirect()->route('localidades.index')
        ->with('success','Localidad creada');
    }


    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        $provincias = Provincia::all();

        return view('backend.localidades.edit', compact('localidad', 'provincias'));
    }


    public function update(Request $request,$id)
    {
        $localidad = Localidad::findOrFail($id);

        $localidad->update($request->all());

        return redirect()->route('localidades.index')
        ->with('success','Localidad actualizada');
    }


    public function destroy($id)
    {
        Localidad::destroy($id);

        return back()->with('success','Localidad eliminada');
    }

}