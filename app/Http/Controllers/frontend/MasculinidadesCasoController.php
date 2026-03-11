<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\{Persona, MasculinidadesCaso,
 Encargado, MasculinidadesDerivacion,SituacionSanitaria,SituacionHabitacional,NivelEstudio,EspacioGrupal,MedidaCautelar,TipoViolencia,DireccionGeneroCaso,
  TipoIntervencion, MasculinidadesIntervencion, Adjunto};

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;

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
    
        $personasConCaso = MasculinidadesCaso::pluck('persona_id');

        $agresores = Persona::leftJoin('direccion_genero_casos', 'personas.id', '=', 'direccion_genero_casos.agresor_id')
            ->where('personas.agresor', 1)
            ->where(function($q){
                $q->where('personas.debe_asistir_masculinidades', 1)
                ->orWhere('direccion_genero_casos.debe_asistir_masculinidades', 1);
            })
            ->whereNotIn('personas.id', $personasConCaso)
            ->select('personas.*')
            ->distinct()
            ->orderBy('personas.apellido')
            ->get();
        $niveles = DB::table('niveles_estudio')->orderBy('nombre')->get();
        $estadosCiviles = DB::table('estados_civiles')->orderBy('nombre')->get();
        $derivaciones = MasculinidadesDerivacion::orderBy('nombre')->get();
        $situacionesHabitacionales = SituacionHabitacional::orderBy('nombre')->get();
        $nivelesEstudio = NivelEstudio::orderBy('nombre')->get();
        $medidasCautelares = MedidaCautelar::orderBy('nombre')->get();
        $tipoViolencia = TipoViolencia::orderBy('nombre')->get();
        $situacionSanitaria = SituacionSanitaria::orderBy('nombre')->get();
        $espacioGrupal = EspacioGrupal::orderBy('nombre')->get();

        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id', 4);
        })->orderBy('apellido')->get();

        return view('frontend.areas.masculinidades.create', compact(
            'agresores',
            'derivaciones',
            'situacionesHabitacionales',
            'situacionSanitaria',
            'nivelesEstudio',
            'encargados', 
            'medidasCautelares',
            'tipoViolencia',
            'espacioGrupal',
            'niveles',
            'estadosCiviles'
        ));
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'persona_id' => 'required|exists:personas,id',
        'derivacion_id' => 'required|exists:masculinidades_derivaciones,id',
        'situacion_habitacional_id' => 'nullable|exists:situaciones_habitacionales,id',
        'situacion_sanitaria_id'=> 'nullable|exists:situaciones_sanitarias,id',
        'encargado_id' => 'nullable|exists:encargados,id',
        'reincidencia' => 'nullable|integer|min:0',
        'asistencia_dispositivo' => 'nullable|integer|in:1,2,3,4',
        'espacio_grupal_id'=> 'nullable|exists:espacios_grupales,id',
        'situacion_judicial' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'detalle_trabajo' => 'nullable|string|max:255',
        'trabaja' => 'nullable|boolean',
        'consumo' => 'nullable|boolean',
        'desobediencia' => 'nullable|boolean',
        'terapia' => 'nullable|boolean',
        'medida_id' => 'nullable|array',
        'medida_id.*' => 'exists:medidas_cautelares,id',
        'tipo_violencia_id' => 'nullable|array',
        'tipo_violencia_id.*' => 'exists:tipos_violencia,id',
        'certificado' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'grupo' => 'nullable|array',
        'nivel_estudio_id' => 'nullable|exists:niveles_estudio,id',
        'estado_civil_id' => 'nullable|exists:estados_civiles,id',
    ]);

    // Procesar checkboxes
    $validated['trabaja'] = $request->has('trabaja');
    $validated['consumo'] = $request->has('consumo');
    $validated['desobediencia'] = $request->has('desobediencia');
    $validated['terapia'] = $request->has('terapia');

    // Crear el caso
    $caso = MasculinidadesCaso::create($validated);

    if ($request->has('medida_id')) $caso->medidas()->attach($request->medida_id);
    if ($request->has('tipo_violencia_id')) $caso->tiposViolencia()->attach($request->tipo_violencia_id);

    // Grupo familiar
    if ($request->has('grupo')) {
        foreach ($request->grupo as $familiar) {
            if (!empty($familiar['nombre'])) {
                $caso->grupoFamiliar()->create([
                    'nombre' => $familiar['nombre'],
                    'apellido' => $familiar['apellido'] ?? null,
                    'dni' => $familiar['dni'] ?? null,
                    'telefono' => $familiar['telefono'] ?? null,
                    'vinculo_actual' => $familiar['vinculo'] ?? null,
                ]);
            }
        }
    }

    $persona = Persona::find($request->persona_id);
    $dni = preg_replace('/[^0-9]/', '', (string) $persona->dni);
    $numeroCaso = str_pad($caso->id, 6, "0", STR_PAD_LEFT);
    $usuario = auth()->user()->name ?? 'Usuario';

    $asistenciaTexto = [
        1 => 'Asistencia regular',
        2 => 'Asistencia irregular',
        3 => 'Abandonó',
        4 => 'Finalizado'
    ];

    // --- GENERACIÓN DE WORD usando plantilla ---
    $templatePath = storage_path('app/plantillas/plantilla_masculinidades.docx');
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

    $templateProcessor->setValue('fecha', now()->format('d/m/Y'));
    $templateProcessor->setValue('numero_caso', $numeroCaso);
    $templateProcessor->setValue('usuario', $usuario);

    // Datos del agresor
    $templateProcessor->setValue('agresor_nombre', $persona->nombre);
    $templateProcessor->setValue('agresor_apellido', $persona->apellido);
    $templateProcessor->setValue('agresor_dni', $persona->dni);
    $templateProcessor->setValue('asistencia_dispositivo', $asistenciaTexto[$caso->asistencia_dispositivo] ?? 'No aplica / Sin datos');
    $templateProcessor->setValue('trabaja', $caso->trabaja ? 'Sí' : 'No');
    $templateProcessor->setValue('consumo', $caso->consumo ? 'Sí' : 'No');
    $templateProcessor->setValue('terapia', $caso->terapia ? 'Sí' : 'No');
    $templateProcessor->setValue('desobediencia', $caso->desobediencia ? 'Sí' : 'No');

    // Situaciones
    $templateProcessor->setValue('situacion_habitacional', $caso->situacionHabitacional->nombre ?? 'No disponible');
    $templateProcessor->setValue('situacion_sanitaria', $caso->situacionSanitaria->nombre ?? 'No disponible');
    $templateProcessor->setValue('situacion_judicial', $caso->situacion_judicial ?? 'No aplica');

    // Observaciones
    $templateProcessor->setValue('observaciones', $caso->observaciones ?? 'Sin observaciones');

    // Grupo familiar dinámico
    foreach($caso->grupoFamiliar as $index => $familiar){
        $i = $index + 1;
        $templateProcessor->setValue("familiar_nombre_{$i}", $familiar->nombre);
        $templateProcessor->setValue("familiar_apellido_{$i}", $familiar->apellido ?? '');
        $templateProcessor->setValue("familiar_dni_{$i}", $familiar->dni ?? '');
        $templateProcessor->setValue("familiar_telefono_{$i}", $familiar->telefono ?? '');
        $templateProcessor->setValue("familiar_vinculo_{$i}", $familiar->vinculo_actual ?? '');
    }

    // Medidas y violencia
    $medidasTexto = implode("\n", $caso->medidas->pluck('nombre')->toArray());
    $tiposViolenciaTexto = implode("\n", $caso->tiposViolencia->pluck('nombre')->toArray());
    $templateProcessor->setValue('medidas', $medidasTexto ?: 'No aplica');
    $templateProcessor->setValue('tipos_violencia', $tiposViolenciaTexto ?: 'No aplica');

    // Guardar el Word
    $nombreWord = "caso_masc_{$numeroCaso}_{$dni}.docx";
    $rutaWord = "masculinidades_certificados/".$nombreWord;
    $tempFile = storage_path('app/'.$rutaWord);
    if(!file_exists(dirname($tempFile))) mkdir(dirname($tempFile),0755,true);
    $templateProcessor->saveAs($tempFile);

    // Guardar en adjuntos
    Adjunto::create([
        'entidad_tipo' => 'masculinidades',
        'entidad_id' => $caso->id,
        'nombre_original' => $nombreWord,
        'nombre_guardado' => $nombreWord,
        'ruta' => $rutaWord,
        'tipo_mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'tamaño' => filesize($tempFile),
        'hash_sha256' => hash_file('sha256',$tempFile),
        'subido_por' => auth()->id(),
        'confidencial' => 0
    ]);

    return redirect()->route('masculinidades.listado')->with('success', 'Caso registrado correctamente y Word generado.');
}
    public function edit($id)
    {
        $caso = MasculinidadesCaso::with([
            'medidas',
            'tiposViolencia',
            'grupoFamiliar',
            'intervenciones.tipo', 
            'intervenciones.encargado'
        ])->findOrFail($id);


        $tiposIntervencion = TipoIntervencion::all();

        $agresores = Persona::where('sexo', 'Masculino')->get();
        $casosGenero = DireccionGeneroCaso::with('persona')->get();

        $victimas = Persona::all();

        $niveles = DB::table('niveles_estudio')->orderBy('nombre')->get();
        $estadosCiviles = DB::table('estados_civiles')->orderBy('nombre')->get();
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
            'encargados',
            'tiposIntervencion',
            'niveles',
            'estadosCiviles'
        ));
    }

    public function update(Request $request, $id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);

        $datos = $request->except(['victimas']);

        $camposCheckbox = ['trabaja','consumo','desobediencia','terapia'];
        foreach ($camposCheckbox as $campo) {
            $datos[$campo] = $request->has($campo) ? 1 : 0;
        }

        $caso->grupoFamiliar()->delete();

        if ($request->has('grupo')) {
            foreach ($request->grupo as $familiar) {
                if (!empty($familiar['nombre'])) {
                    $caso->grupoFamiliar()->create([
                        'nombre' => $familiar['nombre'],
                        'apellido' => $familiar['apellido'] ?? null,
                        'dni' => $familiar['dni'] ?? null,
                        'telefono' => $familiar['telefono'] ?? null,
                        'vinculo_actual' => $familiar['vinculo'] ?? null,
                    ]);
                }
            }
        }

        $caso->update($datos);

        $caso->tiposViolencia()->sync($request->input('tipo_violencia_id', []));
        $caso->medidas()->sync($request->input('medida_id', []));

        if ($request->has('victimas')) {

            $syncData = [];

            foreach ($request->victimas as $victimaId => $v) {
                $syncData[$victimaId] = [
                    'hijos_en_comun' => $v['hijos_en_comun'] ?? 0,
                    'relacion_actual' => $v['relacion_actual'] ?? 0,
                    'descripcion_relacion' => $v['descripcion_relacion'] ?? null,
                ];
            }

            $caso->victimas()->sync($syncData);

        } else {
            $caso->victimas()->sync([]);
        }

        return redirect()
            ->route('masculinidades.listado')
            ->with('success', 'Caso actualizado correctamente.');
    }
    public function destroy(string $id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);
        $caso->delete();

        return redirect()
            ->route('masculinidades.listado')
            ->with('success', 'Caso eliminado correctamente');
    }
}
