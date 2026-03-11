<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{DireccionGeneroCaso, Persona, Provincia, Localidad, Barrio, EstadoCivil, NivelEstudio, IveCaso, MasculinidadesCaso, Encargado, TipoViolencia, RedContencion, TipoIntervencion,SituacionHabitacional,MedidaCautelar,Adjunto};
use Illuminate\Http\Request;

class DireccionGeneroController extends Controller
{
    public function index()
    {
        $casos = DireccionGeneroCaso::with('persona')->orderBy('id', 'desc')->get();
        
        return view('frontend.areas.genero.index', compact('casos'));
    }

    public function listado()
    {
        $legajos = DireccionGeneroCaso::with([
            'persona',
            'localidad',
            'estadoCivil',
            'nivelEstudio',
            'encargado'
        ])->get();
        
        return view('frontend.areas.genero.listado', compact('legajos'));
    }

    public function create()
    {
        $idsConLegajo = DireccionGeneroCaso::pluck('persona_id')->toArray();
        
        $personas = Persona::select(
                'id',
                'apellido',
                'nombre',
                'dni',
                'provincia_id',
                'localidad_id',
                'barrio_id',
                'nivel_estudio_id',
                'trabaja'
                
            )
            ->where('victima','1')
            ->whereNotIn('id', $idsConLegajo)
            ->orderBy('apellido')
            ->get();
        $medida = MedidaCautelar::orderBy('nombre')->get();
        $agresores = Persona::where('agresor',1)->withCount(['casosAgresor'])->get();
        $idsIve = IveCaso::pluck('persona_id')->toArray();
        $provincias = Provincia::orderBy('nombre')->get();
        $localidades = Localidad::orderBy('nombre')->get();
        $barrios = Barrio::orderBy('nombre')->get();
        $estados_civiles = EstadoCivil::orderBy('nombre')->get();
        $niveles_estudio = NivelEstudio::orderBy('nombre')->get();
        $tipos_violencia = TipoViolencia::all(); 
        $situacionesHabitacionales = SituacionHabitacional::orderBy('nombre')->get();
        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id',1);
        })->get();

        return view('frontend.areas.genero.create', compact(
            'personas',
            'provincias',
            'localidades',
            'barrios',
            'estados_civiles',
            'niveles_estudio',
            'idsIve',
            'encargados',
            'agresores',
            'medida',
            'tipos_violencia',
            'situacionesHabitacionales'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id|unique:direccion_genero_casos,persona_id',
            'agresor_id' => 'nullable|exists:personas,id',
            'situacion_habitacional_id' => 'nullable|exists:situaciones_habitacionales,id',
            
        ]);
        
        $denuncioAntes = $request->has('denuncio_antes') ? 1 : 0;
        $medida_cautelar_id = $request->medida_cautelar_id;
    
        $amenazaArma = $request->has('amenaza_con_arma') ? 1 : 0;
        $servicios_luz = $request->has('servicios_luz') ? 1 : 0;
        $servicios_cable = $request->has('servicios_cable') ? 1 : 0;
        $servicios_gas = $request->has('servicios_gas_natural') ? 1 : 0;
        $servicios_agua = $request->has('servicios_agua_potable') ? 1 : 0;
        $servicios_internet = $request->has('servicios_internet') ? 1 : 0;

        $trabaja = $request->has('trabaja') ? 1 : 0;
        $orgSocial = $request->has('organizacion_social') ? 1 : 0;
        $cursoMasculinidades = $request->has('debe_asistir_masculinidades') ? 1 : 0;

        DireccionGeneroCaso::create([
            'persona_id' => $request->persona_id,
            'estado_civil_id' => $request->estado_civil_id,
            'genero' => $request->genero,
            'amenaza_tipo_arma' => $request->amenaza_tipo_arma,
            'tipo_violencia_id' => $request->tipo_violencia,
            'provincia_id' => $request->provincia_id,
            'localidad_id' => $request->localidad_id,
            'barrio_id' => $request->barrio_id,
            'medida_cautelar_id' => $request->medida_cautelar_id,
            'nivel_estudio_id' => $request->nivel_estudio_id,
            'trabaja' => $trabaja,
            'organizacion_social' => $orgSocial,
            'organizacion_social_detalle' => $request->organizacion_social_detalle,
            'debe_asistir_masculinidades' => $cursoMasculinidades,
            'observaciones' => $request->observaciones,
            'encargado_id' => $request->encargado_id,
            'agresor_id' => $request->agresor_id,
            'servicios_luz' => $servicios_luz,
            'servicios_cable' => $servicios_cable,
            'servicios_gas_natural' => $servicios_gas,
            'servicios_agua_potable' => $servicios_agua,
            'servicios_internet' => $servicios_internet,
            'denuncio_antes' => $denuncioAntes,
            'denuncio_antes_detalle' => $request->denuncio_antes_detalle,
            'amenaza_con_arma' => $amenazaArma,
            'fecha_ultima_denuncia' => $request->fecha_ultima_denuncia,
            'boton_panico_numero' => $request->boton_panico_numero,
            'situacion_habitacional_id' => $request->situacion_habitacional_id,
            'agresor_trabajo' => $request->agresor_trabajo
        ]);

        return redirect()->route('genero.listado')->with('success','Legajo creado correctamente');
    }

    public function edit($id)
{
    $legajo = DireccionGeneroCaso::with([
        'persona',
        'intervenciones.tipo',
        'intervenciones.encargado',
        'intervenciones.adjunto'
    ])->findOrFail($id);

    $personas = Persona::where('sexo', 'Femenino')->orderBy('apellido')->get();
    $barrios = Barrio::orderBy('nombre', 'asc')->get();
    $casosMasculinidades = MasculinidadesCaso::with('persona')->get();

    $existeEnIve = IveCaso::where('persona_id', $legajo->persona_id)->exists();

    $provincias = Provincia::orderBy('nombre')->get();
    $localidades = Localidad::orderBy('nombre')->get();
    $barrios = Barrio::orderBy('nombre')->get();
    $estados_civiles = EstadoCivil::orderBy('nombre')->get();
    $niveles_estudio = NivelEstudio::orderBy('nombre')->get();
    $tiposIntervencion = TipoIntervencion::orderBy('nombre')->get();
    $tipos_violencia = TipoViolencia::all(); 
    $situacionesHabitacionales = SituacionHabitacional::orderBy('nombre')->get();
    $medida = MedidaCautelar::orderBy('nombre')->get();

    $encargados = Encargado::whereHas('areas', function($q){
        $q->where('areas.id',1);
    })->get();

    return view('frontend.areas.genero.edit', compact(
        'legajo',
        'personas',
        'provincias',
        'localidades',
        'barrios',
        'estados_civiles',
        'niveles_estudio',
        'casosMasculinidades',
        'existeEnIve',
        'encargados',
        'tiposIntervencion',
        'tipos_violencia', 
        'situacionesHabitacionales',
        'medida'
    ));
}

   public function update(Request $request, $id)
{
    $legajo = DireccionGeneroCaso::findOrFail($id);

    $request->validate([
        'persona_id' => 'required|exists:personas,id',
    ]);

    $legajo->update([
        'persona_id' => $request->persona_id,
        'estado_civil_id' => $request->estado_civil_id,
        'genero' => $request->genero,
        'provincia_id' => $request->provincia_id,
        'localidad_id' => $request->localidad_id,
        'barrio_id' => $request->barrio_id,
        'nivel_estudio_id' => $request->nivel_estudio_id,

        'trabaja' => $request->trabaja == "1" ? 1 : 0,

        'organizacion_social' => $request->organizacion_social == "1" ? 1 : 0,
        'organizacion_social_detalle' => $request->organizacion_social_detalle,

        'situacion_habitacional_id' => $request->situacion_habitacional_id,

        'servicios_luz' => $request->has('servicios_luz') ? 1 : 0,
        'servicios_cable' => $request->has('servicios_cable') ? 1 : 0,
        'servicios_gas_natural' => $request->has('servicios_gas_natural') ? 1 : 0,
        'servicios_agua_potable' => $request->has('servicios_agua_potable') ? 1 : 0,
        'servicios_internet' => $request->has('servicios_internet') ? 1 : 0,

        'tipo_violencia_id' => $request->tipo_violencia_id,
        'medida_cautelar_id' => $request->medida_cautelar_id,
        'fecha_ultima_denuncia' => $request->fecha_ultima_denuncia,

        'denuncio_antes' => $request->has('denuncio_antes') ? 1 : 0,
        'denuncio_antes_detalle' => $request->denuncio_antes_detalle,

        'amenaza_con_arma' => $request->has('amenaza_con_arma') ? 1 : 0,
        'amenaza_tipo_arma' => $request->amenaza_tipo_arma,

        'boton_panico_numero' => $request->boton_panico_numero,

        'agresor_trabajo' => $request->agresor_trabajo,
        'debe_asistir_masculinidades' => $request->has('debe_asistir_masculinidades') ? 1 : 0,

        'observaciones' => $request->observaciones,
        'encargado_id' => $request->encargado_id
    ]);

    if ($request->has('agresores')) {
        $legajo->agresores()->sync($request->agresores);
    } else {
        $legajo->agresores()->detach();
    }

    return redirect()->route('genero.listado')
        ->with('success', 'Legajo actualizado correctamente');
}

    public function destroy($id)
    {
        $legajo = DireccionGeneroCaso::findOrFail($id);
        $legajo->delete();

        return redirect()->route('genero.listado')->with('success', 'Legajo eliminado correctamente');
    }
}