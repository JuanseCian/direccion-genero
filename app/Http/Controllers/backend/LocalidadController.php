<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('backend.localidades.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required'
        ]);

        Localidad::create($request->all());

        return redirect()->route('localidades.index')
        ->with('success','Localidad creada');
    }


    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);

        return view('backend.localidades.edit',
        compact('localidad'));
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