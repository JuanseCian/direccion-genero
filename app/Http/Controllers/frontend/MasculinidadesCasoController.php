<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Persona, MasculinidadesCaso, Encargado};


class MasculinidadesCasoController extends Controller
{
    
    public function index()
    {
        return view('frontend.areas.masculinidades.index');
    }

    public function listado()
    {
        $casos = \App\Models\MasculinidadesCaso::with('persona', 'encargado')->get();
        
        return view('frontend.areas.masculinidades.listado', compact('casos'));
    }

    public function create()
    {
        $personas = \App\Models\Persona::where('sexo', 'Masculino')->get();
        
        $derivaciones = \DB::table('masculinidades_derivaciones')->get();
        $situacionesHabitacionales = \DB::table('situaciones_habitacionales')->get();
        $nivelesEstudio = \DB::table('niveles_estudio')->get();
        $espaciosGrupales = \DB::table('espacios_grupales')->get();
        
        $encargados = \App\Models\Encargado::whereHas('areas', function($q){
            $q->where('areas.id', 4); 
        })->get();

        return view('frontend.areas.masculinidades.create', compact(
            'personas', 
            'derivaciones', 
            'situacionesHabitacionales', 
            'nivelesEstudio', 
            'espaciosGrupales',
            'encargados'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => [
                'required',
                Rule::exists('personas', 'id')->where(function ($query) {
                    $query->where('sexo', 'Masculino');
                }),
            ],
            'derivacion_id' => 'required',
            ]);
        
            MasculinidadesCaso::create($request->all());
            return redirect()->route('masculinidades.index')->with('success', 'Legajo creado correctamente');
    }
}
