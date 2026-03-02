<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SituacionSanitaria;

class SituacionSanitariaController extends Controller
{

    public function index()
    {
        $situaciones = SituacionSanitaria::orderBy('nombre')->get();

        return view(
            'backend.situaciones-sanitarias.index',
            compact('situaciones')
        );
    }


    public function create()
    {
        return view('backend.situaciones-sanitarias.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|max:150|unique:situaciones_sanitarias'
        ]);


        SituacionSanitaria::create($request->all());


        return redirect()
            ->route('backend.situaciones-sanitarias.index')
            ->with('success','Situación sanitaria creada correctamente');
    
    }


    public function edit($id)
    {

        $situacion = SituacionSanitaria::findOrFail($id);

        return view(
            'backend.situaciones-sanitarias.edit',
            compact('situacion')
        );

    }


    public function update(Request $request, $id)
    {

        $situacion = SituacionSanitaria::findOrFail($id);


        $request->validate([
            'nombre' =>
            'required|max:150|unique:situaciones_sanitarias,nombre,'.$id
        ]);


        $situacion->update($request->all());


        return redirect()
        ->route('backend.situaciones-sanitarias.index')
        ->with('success','Situación sanitaria actualizada correctamente');

    }


    public function destroy($id)
    {

        $situacion = SituacionSanitaria::findOrFail($id);

        $situacion->delete();

        return redirect()
        ->route('backend.situaciones-sanitarias.index')
        ->with('deleted','Situación sanitaria eliminada correctamente');
    }

}