<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Barrio;

class PersonaController extends Controller
{


    public function index(Request $request)
    {

        $buscar = $request->buscar;

        $personas = \App\Models\Persona::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where('dni', 'like', "%$buscar%")
                    ->orWhere('nombre', 'like', "%$buscar%")
                    ->orWhere('apellido', 'like', "%$buscar%");
            })
            ->orderBy('apellido')
            ->paginate(10);


        return view(
            'frontend.personas.index',
            compact('personas','buscar')
        );

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