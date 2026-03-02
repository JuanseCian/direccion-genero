<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramaAsistencia;

class ProgramaAsistenciaController extends Controller
{

    public function index()
    {
        $programas = ProgramaAsistencia::orderBy('nombre')->get();
        return view('backend.programas-asistencia.index', compact('programas'));
    }


    public function create()
    {
        return view('backend.programas-asistencia.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:150|unique:programas_asistencia'
        ]);

        ProgramaAsistencia::create($request->all());

        return redirect()->route('backend.programas-asistencia.index')
        ->with('success','Programa creado correctamente');
    }


    public function edit($id)
    {
        $programa = ProgramaAsistencia::findOrFail($id);
        return view('backend.programas-asistencia.edit', compact('programa'));
    }


    public function update(Request $request, $id)
    {
        $programa = ProgramaAsistencia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:150|unique:programas_asistencia,nombre,'.$id
        ]);

        $programa->update($request->all());

        return redirect()->route('backend.programas-asistencia.index')
        ->with('success','Programa actualizado');
    }


    public function destroy($id)
    {
        ProgramaAsistencia::destroy($id);

        return redirect()->route('backend.programas-asistencia.index')
        ->with('success','Programa eliminado');
    }

}