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

        'certificado' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
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

    $persona = Persona::find($request->persona_id);
    $victima = Persona::find($request->victima_id);

    $dni = preg_replace('/[^0-9]/', '', (string) $persona->dni);
    $numeroCaso = str_pad($caso->id, 6, "0", STR_PAD_LEFT);
    $fecha = now()->format('Y-m-d');

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    if(file_exists(public_path('img/logo_institucional.png'))){
        $section->addImage(public_path('img/logo_institucional.png'),[
            'width'=>120,
            'alignment'=>'center'
        ]);
    }

    $section->addText(
        "DIRECCIÓN DE GÉNERO Y DIVERSIDAD",
        ['bold'=>true,'size'=>14],
        ['alignment'=>'center']
    );

    $section->addText(
        "Programa de Masculinidades",
        ['size'=>12],
        ['alignment'=>'center']
    );

    $section->addTextBreak();

    $section->addText("Número de caso: ".$caso->id,['bold'=>true]);
    $section->addText("Fecha: ".now()->format('d/m/Y'));
    $section->addText("Usuario que cargó: ".auth()->user()->name);

    $section->addTextBreak(2);

    $section->addText("Datos del Agresor",['bold'=>true]);

    $table = $section->addTable();

    $table->addRow();
    $table->addCell(3000)->addText("DNI");
    $table->addCell(6000)->addText($persona->dni);

    $table->addRow();
    $table->addCell()->addText("Nombre");
    $table->addCell()->addText($persona->nombre." ".$persona->apellido);

    $table->addRow();
    $table->addCell()->addText("Reincidencia");
    $table->addCell()->addText($caso->reincidencia ?? '-');

    $table->addRow();
    $table->addCell()->addText("Trabaja");
    $table->addCell()->addText($caso->trabaja ? "SI" : "NO");

    $section->addTextBreak();
    $section->addText("Datos de la Víctima",['bold'=>true]);

    $tableVictima = $section->addTable();

    $tableVictima->addRow();
    $tableVictima->addCell(3000)->addText("DNI");
    $tableVictima->addCell(6000)->addText($victima->dni);

    $tableVictima->addRow();
    $tableVictima->addCell()->addText("Nombre");
    $tableVictima->addCell()->addText($victima->nombre." ".$victima->apellido);

    $section->addTextBreak();
    $section->addText("Medidas Cautelares",['bold'=>true]);

    foreach($caso->medidas as $medida){
        $section->addListItem($medida->nombre);
    }

    $section->addTextBreak();
    $section->addText("Tipos de Violencia",['bold'=>true]);

    foreach($caso->tiposViolencia as $tipo){
        $section->addListItem($tipo->nombre);
    }

    $section->addTextBreak();
    $section->addText("Grupo Familiar",['bold'=>true]);

    $tablaGrupo = $section->addTable();

    $tablaGrupo->addRow();
    $tablaGrupo->addCell()->addText("Nombre");
    $tablaGrupo->addCell()->addText("Apellido");
    $tablaGrupo->addCell()->addText("Teléfono");
    $tablaGrupo->addCell()->addText("Vínculo");

    foreach($caso->grupoFamiliar as $familiar){

        $tablaGrupo->addRow();
        $tablaGrupo->addCell()->addText($familiar->nombre);
        $tablaGrupo->addCell()->addText($familiar->apellido);
        $tablaGrupo->addCell()->addText($familiar->telefono);
        $tablaGrupo->addCell()->addText($familiar->vinculo);
    }

    $section->addTextBreak();
    $section->addText("Observaciones",['bold'=>true]);
    $section->addText($caso->observaciones ?? '-');

    $section->addTextBreak(3);

    $section->addText("_______________________________",[],['alignment'=>'center']);
    $section->addText("Responsable del Programa",[],['alignment'=>'center']);

    $nombreWord = "caso_".$numeroCaso."_".$dni."_".$fecha.".docx";
    $rutaWord = "masculinidades_certificados/".$nombreWord;

    $tempFile = storage_path('app/'.$rutaWord);

    if(!file_exists(dirname($tempFile))){
        mkdir(dirname($tempFile),0755,true);
    }

    $phpWord->save($tempFile);

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

    if ($request->hasFile('certificado')) {

        $archivo = $request->file('certificado');
        $extension = $archivo->getClientOriginalExtension();

        $nombreArchivo = "certificado_".$numeroCaso."_".$dni.".".$extension;

        $ruta = $archivo->storeAs(
            'masculinidades_certificados',
            $nombreArchivo
        );

        Adjunto::create([
            'entidad_tipo' => 'masculinidades',
            'entidad_id' => $caso->id,
            'nombre_original' => $archivo->getClientOriginalName(),
            'nombre_guardado' => $nombreArchivo,
            'ruta' => $ruta,
            'tipo_mime' => $archivo->getMimeType(),
            'tamaño' => $archivo->getSize(),
            'hash_sha256' => hash_file('sha256', $archivo->getRealPath()),
            'subido_por' => auth()->id(),
            'confidencial' => 0
        ]);
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
            'grupoFamiliar',
            'intervenciones.tipo', 
            'intervenciones.encargado'
        ])->findOrFail($id);

        $tiposIntervencion = TipoIntervencion::all();

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
            'encargados',
            'tiposIntervencion'
        ));
    }

    public function update(Request $request, $id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);
        $caso->fecha_finalizacion = $request->fecha_finalizacion;

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

    public function destroy(string $id)
    {
        $caso = MasculinidadesCaso::findOrFail($id);
        $caso->delete();

        return redirect()
            ->route('masculinidades.listado')
            ->with('success', 'Caso eliminado correctamente');
    }
}
