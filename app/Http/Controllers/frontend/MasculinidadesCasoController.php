<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\{Persona, MasculinidadesCaso,
 Encargado, MasculinidadesDerivacion,SituacionSanitaria,SituacionHabitacional,NivelEstudio,EspacioGrupal,MedidaCautelar,TipoViolencia,DireccionGeneroCaso,
  TipoIntervencion, MasculinidadesIntervencion, Adjunto};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
class MasculinidadesCasoController extends Controller
{
    
    public function index()
    {
        return view('frontend.areas.masculinidades.index');
    }

    public function listado()
    {
        $casos = \App\Models\MasculinidadesCaso::with('persona', 'encargado')
            ->orderBy('created_at','desc')
            ->paginate(15);
            
        return view('frontend.areas.masculinidades.listado', compact('casos'));
    }

    public function create()
    {
    
        //$personasConCaso = MasculinidadesCaso::pluck('persona_id');

        $agresores = Persona::leftJoin('direccion_genero_casos', 'personas.id', '=', 'direccion_genero_casos.agresor_id')
            ->where('personas.agresor', 1)
            ->where(function($q){
                $q->where('personas.debe_asistir_masculinidades', 1)
                ->orWhere('direccion_genero_casos.debe_asistir_masculinidades', 1);
            })
            // 2. ELIMINAR O COMENTAR ESTA LÍNEA PARA PERMITIR MÚLTIPLES CASOS AL MISMO AGRESOR:
            // ->whereNotIn('personas.id', $personasConCaso)
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
            $q->where('areas.id', 2);
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
            'debe_dispositivo' => 'nullable|boolean', // Nuevo campo validado
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
            'grupo' => 'nullable|array',
            'nivel_estudio_id' => 'nullable|exists:niveles_estudio,id',
            'estado_civil_id' => 'nullable|exists:estados_civiles,id',
        ]);

        // 1. PROCESAR CHECKBOXES Y ESTADOS INICIALES
        $validated['trabaja'] = $request->has('trabaja');
        $validated['consumo'] = $request->has('consumo');
        $validated['desobediencia'] = $request->has('desobediencia');
        $validated['terapia'] = $request->has('terapia');

        // Lógica para el ingreso simplificado:
        if ($request->debe_dispositivo == "1") {
            // Al crear, forzamos que sea "Asistencia Regular" (1) y sin fecha de fin
            $validated['asistencia_dispositivo'] = 1;
            $validated['fecha_finalizacion'] = null;
        } else {
            $validated['asistencia_dispositivo'] = null;
            $validated['fecha_finalizacion'] = null;
        }

        DB::beginTransaction();

        try {
            // 2. CREAR CASO
            $caso = MasculinidadesCaso::create($validated);

            // 3. RELACIONES PIVOT (Medidas y Violencias)
            if ($request->has('medida_id')) {
                $caso->medidas()->attach($request->medida_id);
            }

            if ($request->has('tipo_violencia_id')) {
                $caso->tiposViolencia()->attach($request->tipo_violencia_id);
            }

            // 4. GRUPO FAMILIAR
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

            // 5. GENERACIÓN DE DOCUMENTO WORD
            $caso->load([
                'persona', 'estadoCivil', 'nivelEstudio', 
                'situacionHabitacional', 'situacionSanitaria', 
                'medidas', 'tiposViolencia', 'grupoFamiliar'
            ]);

            $rutaWord = $this->generarWordCaso($caso);
            $nombreWord = basename($rutaWord);
            $path = storage_path('app/'.$rutaWord);

            // 6. REGISTRO EN TABLA ADJUNTOS
            Adjunto::create([
                'entidad_tipo' => 'masculinidades',
                'entidad_id' => $caso->id,
                'nombre_original' => $nombreWord,
                'nombre_guardado' => $nombreWord,
                'ruta' => $rutaWord,
                'tipo_mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'tamaño' => filesize($path),
                'hash_sha256' => hash_file('sha256', $path),
                'subido_por' => auth()->id(),
                'confidencial' => 0
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            // Es buena práctica registrar el error para debuggear
            \Log::error("Error creando caso masculinidades: " . $e->getMessage());
            throw $e;
        }

        return redirect()
            ->route('masculinidades.listado')
            ->with('success', 'Caso registrado correctamente con estado inicial: Asistencia Regular.');
    }

    private function generarWordCaso($caso)
    {
        $persona = $caso->persona;

        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'marginTop' => 1000,
            'marginBottom' => 1000,
            'marginLeft' => 1200,
            'marginRight' => 1200
    ]);

        // ENCABEZADO
        $header = $section->addHeader();
        $header->addText(
            'Municipalidad - Dirección de Género',
            ['bold'=>true,'size'=>12],
            ['alignment'=>'center']
        );
        $header->addText(
            'Programa de Masculinidades',
            ['size'=>11],
            ['alignment'=>'center']
        );

        $section->addTextBreak(2);

        // TITULO
        $section->addText(
            'INFORME DE CASO',
            ['bold'=>true,'size'=>16],
            ['alignment'=>'center']
        );

        $section->addTextBreak(2);

        // DATOS GENERALES
        $table = $section->addTable();

        $table->addRow();
        $table->addCell(4000)->addText('Fecha');
        $table->addCell(6000)->addText(now()->format('d/m/Y'));

        $table->addRow();
        $table->addCell()->addText('Número de caso');
        $table->addCell()->addText($caso->id);

        $section->addTextBreak();

        // DATOS DEL AGRESOR
        $section->addText('DATOS DEL AGRESOR',['bold'=>true]);

        $table = $section->addTable();

        $table->addRow();
        $table->addCell(4000)->addText('Nombre');
        $table->addCell(6000)->addText($persona->nombre.' '.$persona->apellido);

        $table->addRow();
        $table->addCell()->addText('DNI');
        $table->addCell()->addText($persona->dni);

        $table->addRow();
        $table->addCell()->addText('Estado civil');
        $table->addCell()->addText($caso->estadoCivil->nombre ?? '');

        $table->addRow();
        $table->addCell()->addText('Nivel de estudio');
        $table->addCell()->addText($caso->nivelEstudio->nombre ?? '');

        $section->addTextBreak();

        // SITUACION
        $section->addText('SITUACIÓN',['bold'=>true]);

        $table = $section->addTable();

        $table->addRow();
        $table->addCell()->addText('Habitacional');
        $table->addCell()->addText($caso->situacionHabitacional->nombre ?? '');

        $table->addRow();
        $table->addCell()->addText('Sanitaria');
        $table->addCell()->addText($caso->situacionSanitaria->nombre ?? '');

        $table->addRow();
        $table->addCell()->addText('Judicial');
        $table->addCell()->addText($caso->situacion_judicial ?? '');

        $section->addTextBreak();

        // MEDIDAS
        $section->addText('MEDIDAS CAUTELARES',['bold'=>true]);

        foreach($caso->medidas as $m){
            $section->addText('- '.$m->nombre);
        }

        $section->addTextBreak();

        // VIOLENCIAS
        $section->addText('TIPOS DE VIOLENCIA',['bold'=>true]);

        foreach($caso->tiposViolencia as $v){
            $section->addText('- '.$v->nombre);
        }

        $section->addTextBreak();

        // GRUPO FAMILIAR
        $section->addText('GRUPO FAMILIAR',['bold'=>true]);

    $table = $section->addTable();

    $table->addRow();

    $table->addCell(3500)->addText('Nombre', ['bold'=>true]);
    $table->addCell(2000)->addText('DNI', ['bold'=>true]);
    $table->addCell(3000)->addText('Teléfono', ['bold'=>true]);
    $table->addCell(2500)->addText('Vínculo', ['bold'=>true]);

    foreach ($caso->grupoFamiliar as $f){

        $table->addRow();

        $table->addCell(3500)->addText($f->nombre.' '.$f->apellido);
        $table->addCell(2000)->addText($f->dni);
        $table->addCell(3000)->addText($f->telefono);
        $table->addCell(2500)->addText($f->vinculo_actual);
    }

        foreach($caso->grupoFamiliar as $f){

            $table->addRow();

            $table->addCell()->addText($f->nombre.' '.$f->apellido);
            $table->addCell()->addText($f->dni);
            $table->addCell()->addText($f->telefono);
            $table->addCell()->addText($f->vinculo_actual);
        }

        $section->addTextBreak();

        // OBSERVACIONES
        $section->addText('OBSERVACIONES',['bold'=>true]);
        $section->addText($caso->observaciones ?? '');

        $numeroCaso = str_pad($caso->id,6,"0",STR_PAD_LEFT);
        $dni = preg_replace('/[^0-9]/','',$persona->dni);

        $nombreWord = "caso_masc_{$numeroCaso}_{$dni}.docx";
        $ruta = "masculinidades_certificados/".$nombreWord;
        $path = storage_path('app/'.$ruta);

        if(!file_exists(dirname($path))){
            mkdir(dirname($path),0755,true);
        }

        $writer = IOFactory::createWriter($phpWord,'Word2007');
        $writer->save($path);

        return $ruta;
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

        $agresores = Persona::where('sexo', 'Masculino')
            ->orWhere('id', $caso->persona_id)
            ->orderBy('apellido')
            ->get();
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
                $q->where('areas.id', 2);
            })->get();

        $historial = MasculinidadesCaso::where('persona_id', $caso->persona_id)
            ->where('id', '!=', $caso->id)
            ->orderBy('created_at', 'desc')
            ->get();

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
            'estadosCiviles',
            'historial'
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

        if ($request->debe_dispositivo == "1") {
            if (in_array($request->asistencia_dispositivo, [3, 4])) {
                $datos['fecha_finalizacion'] = $request->fecha_finalizacion 
                                            ?? ($caso->fecha_finalizacion ?? now());
            } else {
                $datos['fecha_finalizacion'] = null;
            }
        } else {
            $datos['asistencia_dispositivo'] = null;
            $datos['fecha_finalizacion'] = null;
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

        // Víctimas
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
    public function descargarWord($id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);

        $user = auth()->user();

        if (
            $user->rol_id != 2 &&
            !$user->areas->contains('nombre','masculinidades')
        ) {
            abort(403);
        }

        $adjunto = Adjunto::where('entidad_tipo','masculinidades')
            ->where('entidad_id',$caso->id)
            ->firstOrFail();

        return Storage::download($adjunto->ruta, $adjunto->nombre_original);
    }
    
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'motivo_eliminacion' => 'required|min:10'
        ]);

        $caso = MasculinidadesCaso::findOrFail($id);
        
        // Asignamos manualmente
        $caso->motivo_eliminacion = $request->motivo_eliminacion;
        $caso->deleted_by = auth()->id();
        
        // Forzamos el guardado de los campos antes del soft delete
        $caso->save(); 

        // Ahora sí, eliminamos
        $caso->delete(); 

        return redirect()->back()->with('success', 'El caso se envió a la papelera correctamente.');
    }
}
