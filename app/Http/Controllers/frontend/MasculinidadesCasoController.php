<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\{Persona, MasculinidadesCaso, Encargado,MasculinidadesDerivacion,SituacionSanitaria,SituacionHabitacional,NivelEstudio,EspacioGrupal,MedidaCautelar,TipoViolencia,DireccionGeneroCaso};


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
    $espacioGrupal=EspacioGrupal::orderBy('nombre')->get();

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
        'tipoViolencia',
        'espacioGrupal'
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

        'espacio_grupal_id'=> 'nullable|exists:espacios_grupales,id',

        'hijos_en_comun' => 'nullable|integer|min:0',

        'situacion_judicial' => 'nullable|string',
        'observaciones' => 'nullable|string',

        
        'descripcion_relacion' => 'nullable|string|max:255',

        'trabaja' => 'nullable|boolean',
        'consumo' => 'nullable|boolean',
        'desobediencia' => 'nullable|boolean',
        'terapia' => 'nullable|boolean',
        'relacion_actual' => 'nullable|boolean',
        
        'medida_id' => 'required|array',
        'medida_id.*' => 'exists:medidas_cautelares,id',

        'tipo_violencia_id' => 'required|array',
        'tipo_violencia_id.*' => 'exists:tipos_violencia,id',
    ]);

   
    $validated['trabaja'] = $request->has('trabaja');
    $validated['consumo'] = $request->has('consumo');
    $validated['desobediencia'] = $request->has('desobediencia');
    $validated['terapia'] = $request->has('terapia');
    $validated['relacion_actual'] = $request->has('relacion_actual');

    
    if (!$validated['relacion_actual']) {
        $validated['descripcion_relacion'] = null;
    }

   
    $caso = MasculinidadesCaso::create($validated);

  
    $caso->medidas()->attach($request->medida_id);
    $caso->tiposViolencia()->attach($request->tipo_violencia_id);

   
    if ($request->has('grupo')) {
        foreach ($request->grupo as $familiar) {
            if (!empty($familiar['nombre'])) {
                $caso->grupoFamiliar()->create([
                    'nombre' => $familiar['nombre'],
                    'apellido' => $familiar['apellido'] ?? null,
                    'telefono' => $familiar['telefono'] ?? null,
                    'vinculo' => $familiar['vinculo'] ?? null,
                ]);
            }
        }
    }

    return redirect()
        ->route('masculinidades.index')
        ->with('success', 'Caso registrado correctamente.');
}

       public function edit($id)
{
    $caso = MasculinidadesCaso::with([
        'medidas',
        'tiposViolencia',
        'grupoFamiliar'
    ])->findOrFail($id);

    $agresores = Persona::where('sexo', 'Masculino')->get();
    $casosGenero = DireccionGeneroCaso::with('persona')->get();

    $victimas = Persona::all();

   
    $derivaciones = DB::table('masculinidades_derivaciones')->get();
    $situacionesHabitacionales = DB::table('situaciones_habitacionales')->get();
    $espaciosGrupales = DB::table('espacios_grupales')->get();
    $situacionSanitaria = DB::table('situaciones_sanitarias')->get();

   
    $tipoViolencia = DB::table('tipos_violencia')->get();
    $medidasCautelares = DB::table('medidas_cautelares')->get();

   
    $encargados = Encargado::whereHas('areas', function($q){
        $q->where('areas.id', 4);
    })->get();

    return view('frontend.areas.masculinidades.edit', compact(
        'caso',
        'agresores',
        'casosGenero',
        'victimas',
        'derivaciones',
        'situacionesHabitacionales',
        'espaciosGrupales',
        'situacionSanitaria',
        'tipoViolencia',
        'medidasCautelares',
        'encargados'
    ));
}

  public function update(Request $request, $id)
{
    $caso = MasculinidadesCaso::findOrFail($id);

    $datos = $request->all();

    $camposCheckbox = [
        'trabaja',
        'consumo',
        'desobediencia',
        'reincidencia',
        'terapia',
        'red_contencion',
        'relacion_actual'
    ];

    foreach ($camposCheckbox as $campo) {
        $datos[$campo] = $request->has($campo) ? 1 : 0;
    }

    if ($request->has('victimas')) {
            $caso->victimas()->sync($request->victimas);
        } else {
            $caso->victimas()->detach(); // Si se eliminan todas en la vista
        }   

    if (!$request->has('relacion_actual')) {
        $datos['descripcion_relacion'] = null;
    }

    $caso->update($datos);

    if ($request->has('tipos_violencia')) {
        $caso->tiposViolencia()->sync($request->tipos_violencia);
    } else {
        $caso->tiposViolencia()->sync([]);
    }

    if ($request->has('medidas_cautelares')) {
        $caso->medidas()->sync($request->medidas_cautelares);
    } else {
        $caso->medidas()->sync([]);
    }

    $caso->grupoFamiliar()->delete();

    if ($request->has('grupo_familiar')) {
        foreach ($request->grupo_familiar as $familiar) {
            if (!empty($familiar['nombre'])) {
                $caso->grupoFamiliar()->create([
                    'nombre' => $familiar['nombre'],
                    'apellido' => $familiar['apellido'] ?? null,
                    'telefono' => $familiar['telefono'] ?? null,
                    'vinculo' => $familiar['vinculo'] ?? null,
                ]);
            }
        }
    }

    return redirect()
        ->route('masculinidades.listado')
        ->with('success', 'Caso actualizado correctamente.');
}
}
