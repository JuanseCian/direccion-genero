<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SituacionHabitacional;

class SituacionHabitacionalController extends Controller
{

    public function index()
    {
        $situaciones = SituacionHabitacional::orderBy('nombre')->get();

        return view(
            'backend.situaciones-habitacionales.index',
            compact('situaciones')
        );
    }


    public function create()
    {
        return view('backend.situaciones-habitacionales.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|max:150|unique:situaciones_habitacionales'
        ]);


        $situacion = SituacionHabitacional::create($request->all());

        return redirect()
            ->route('backend.situaciones-habitacionales.index')
            ->with('success','Situación habitacional creada correctamente');

    
    }



    public function edit($id)
    {
        $situacion = SituacionHabitacional::findOrFail($id);

        return view(
            'backend.situaciones-habitacionales.edit',
            compact('situacion')
        );
    }



    public function update(Request $request, $id)
    {

        $situacion = SituacionHabitacional::findOrFail($id);


        $request->validate([
            'nombre' =>
            'required|max:150|unique:situaciones_habitacionales,nombre,'.$id
        ]);


        $situacion = SituacionHabitacional::findOrFail($id);

        $situacion->update($request->all());

        return redirect()
        ->route('backend.situaciones-habitacionales.index')
        ->with('success','Situación habitacional actualizada correctamente');

    }



    public function destroy($id)
    {

        $situacion = SituacionHabitacional::findOrFail($id);

        $situacion->delete();

        return redirect()
        ->route('backend.situaciones-habitacionales.index')
        ->with('deleted','Situación habitacional eliminada correctamente');

    }

}