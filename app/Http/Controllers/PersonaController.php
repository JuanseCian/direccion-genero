<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Barrio;

class PersonaController extends Controller
{


    public function index() {
        $personas = Persona::with(['casosIve', 'casosGenero'])->get();
        return view('frontend.personas.index', compact('personas'));
    }


    public function create()
    {
        $barrios = Barrio::orderBy('nombre')->get();

        return view('frontend.personas.create', compact('barrios'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'required|unique:personas',
            'fecha_nacimiento'=>'nullable|date',
            'barrio_id'=>'nullable',
            'trabaja'=>'nullable',
            'grupo_sanguineo'=>'nullable'
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')
        ->with('success','Persona creada correctamente');
    }

}