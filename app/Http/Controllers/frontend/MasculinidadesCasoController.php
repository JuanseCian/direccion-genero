<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{Persona, MasculinidadesCaso, Encargado,MasculinidadesDerivacion,SituacionSanitaria,SituacionHabitacional,NivelEstudio,EspacioGrupal,MedidaCautelar,TipoViolencia};


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
    // Traemos solo Masculino y Femenino en una sola consulta
    $personas = Persona::select('id','apellido','nombre','dni','sexo')
        ->whereIn('sexo', ['Masculino','Femenino'])
        ->orderBy('apellido')
        ->get();

    // Filtramos en colección (no hace nueva consulta)
    $agresores = $personas->where('sexo', 'Masculino');
    $victimas = $personas->where('sexo', 'Femenino');

    $derivaciones = MasculinidadesDerivacion::orderBy('nombre')->get();
    $situacionesHabitacionales = SituacionHabitacional::orderBy('nombre')->get();
    $nivelesEstudio = NivelEstudio::orderBy('nombre')->get();
    $espaciosGrupales = EspacioGrupal::orderBy('nombre')->get();
    $medidasCautelares = MedidaCautelar::orderBy('nombre')->get();
    $tipoViolencia=TipoViolencia::orderBy('nombre')->get() ;
    $situacionSanitaria=SituacionSanitaria::orderBy('nombre')->get();

    $encargados = Encargado::whereHas('areas', function($q){
        $q->where('areas.id', 4);
    })->orderBy('apellido')->get();

    return view('frontend.areas.masculinidades.create', compact(
        'agresores',
        'victimas',
        'derivaciones',
        'situacionesHabitacionales',
        'situacionSanitaria',
        'nivelesEstudio',
        'espaciosGrupales',
        'encargados', 
        'medidasCautelares',
        'tipoViolencia'
    ));
}

   public function store(Request $request)
{
    $validated = $request->validate([
        'persona_id' => 'required|exists:personas,id',
        'victima_id' => 'required|exists:personas,id|different:persona_id',

        'derivacion_id' => 'required|exists:masculinidades_derivaciones,id',
        'situacion_habitacional_id' => 'nullable|exists:situaciones_habitacionales,id',
        'situacion_sanitaria_id'=> 'nullable|exists:situaciones_sanitarias,id',
        'encargado_id' => 'nullable|exists:encargados,id',

        'reincidencia' => 'nullable|integer|min:0',
        'asistencia_dispositivo' => 'nullable|integer|min:0',
        'hijos_en_comun' => 'nullable|integer|min:0',

        'situacion_judicial' => 'nullable|string',
        'observaciones' => 'nullable|string',

        'trabaja' => 'nullable|boolean',
        'consumo' => 'nullable|boolean',
        'desobediencia' => 'nullable|boolean',
        'terapia' => 'nullable|boolean',

        'medida_id' => 'required|array',
        'medida_id.*' => 'exists:medidas_cautelares,id',

        'tipo_violencia_id' => 'required|array',
        'tipo_violencia_id.*' => 'exists:tipos_violencia,id',
    ]);

    // Manejo de checkboxes
    $validated['trabaja'] = $request->has('trabaja');
    $validated['consumo'] = $request->has('consumo');
    $validated['desobediencia'] = $request->has('desobediencia');
    $validated['terapia'] = $request->has('terapia');

    // 1️⃣ Crear caso
    $caso = MasculinidadesCaso::create($validated);

    // 2️⃣ Guardar relaciones many-to-many
    $caso->medidas()->attach($request->medida_id);
    $caso->tiposViolencia()->attach($request->tipo_violencia_id);

    return redirect()
        ->route('masculinidades.index')
        ->with('success', 'Caso registrado correctamente.');
}

        public function edit($id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);
        
        $legajo = $caso;

        $personas = Persona::where('sexo', 'Masculino')->get();
        
        $derivaciones = \DB::table('masculinidades_derivaciones')->get();
        $situacionesHabitacionales = \DB::table('situaciones_habitacionales')->get();
        $nivelesEstudio = \DB::table('niveles_estudio')->get();
        $espaciosGrupales = \DB::table('espacios_grupales')->get();
        $situacionesSanitarias = \DB::table('situaciones_sanitarias')->get();

        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id', 4); // ID de Masculinidades
        })->get();

        return view('frontend.areas.masculinidades.edit', compact(
            'caso', 
            'legajo', 
            'personas', 
            'derivaciones', 
            'situacionesHabitacionales', 
            'nivelesEstudio', 
            'espaciosGrupales',
            'situacionesSanitarias',
            'encargados'
        ));
    }

    public function update(Request $request, $id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);
        
        $datos = $request->all();
        $camposCheckbox = ['trabaja', 'consumo', 'desobediencia', 'reincidencia', 'terapia', 'red_contencion'];
        
        foreach ($camposCheckbox as $campo) {
            $datos[$campo] = $request->has($campo) ? 1 : 0;
        }

        $caso->update($datos);

        return redirect()->route('masculinidades.listado')->with('success', 'Legajo actualizado correctamente.');
    }
}
