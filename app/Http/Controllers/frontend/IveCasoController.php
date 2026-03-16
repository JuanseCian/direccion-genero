<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona; 
use App\Models\IveCaso;
use App\Models\Encargado;
use App\Models\DireccionGeneroCaso;
use App\Models\TipoViolencia;
use App\Models\TipoIntervencion;
use App\Models\RedContencion;
use App\Models\EstadoCivil;
use App\Models\Adjunto;
use App\Models\MetodoInterrupcion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
class IveCasoController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $tieneAreaIVE = $user->rol_id == 2 || $user->areas->contains('id', 3);

    if ($tieneAreaIVE) {

        // ve todos los casos
        $casos = IveCaso::with('persona')
            ->orderBy('created_at','desc')
            ->paginate(10);

    } else {

        // solo casos asignados
        $casos = $user->iveCasos()
            ->with('persona')
            ->orderBy('created_at','desc')
            ->get();

        if ($casos->isEmpty()) {
            abort(403, 'No tiene acceso');
        }
    }

    return view('frontend.areas.ive.index', compact('casos'));
}
public function descargarWord($id)
{
    $caso = IveCaso::findOrFail($id);

    $user = auth()->user();

    // seguridad
    if (
        $user->rol_id != 2 &&
        !$user->areas->contains('nombre','ive') &&
        !$user->iveCasos->contains($caso->id)
    ) {
        abort(403);
    }

    $adjunto = Adjunto::where('entidad_tipo','ive')
        ->where('entidad_id',$caso->id)
        ->firstOrFail();

    return Storage::download($adjunto->ruta, $adjunto->nombre_original);
}
    public function create()
    {
        $idsConCaso = IveCaso::pluck('persona_id')->toArray();

        $personas = Persona::where('sexo', 'Femenino')
            ->whereNotIn('id', $idsConCaso)
            ->orderBy('apellido')
            ->get();

        $encargados = Encargado::whereHas('areas', function($q){
            $q->where('areas.id',3);
        })->get();

        $idsEnGenero = DireccionGeneroCaso::pluck('persona_id')->toArray();
        $tiposViolencia = TipoViolencia::orderBy('nombre')->get();
        $estadosCiviles = EstadoCivil::orderBy('nombre')->get();
        $metodos = MetodoInterrupcion::orderBy('nombre')->get();
        $redes = RedContencion::orderBy('nombre')->get();

        return view('frontend.areas.ive.create', compact(
            'personas',
            'idsEnGenero',
            'encargados',
            'tiposViolencia',
            'redes',
            'estadosCiviles',
            'metodos'
        ));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fum' => 'nullable|date',
            'eco_semanas' => 'nullable|integer',
            'cantidad_hijos' => 'integer|min:0',
            'encargado_id' => 'required|exists:encargados,id',

            'tipos_violencia' => 'nullable|array',
            'tipos_violencia.*' => 'exists:tipos_violencia,id',

            'redes_contencion' => 'nullable|array',
            'redes_contencion.*' => 'exists:red_contencion,id',

            'medicaciones.*.nombre' => 'nullable|string|max:255',
            'medicaciones.*.numero_lote' => 'nullable|string|max:255',

            'semanas_gestacion' => 'nullable|integer|min:0',
            'estado_civil_id' => 'nullable|exists:estados_civiles,id',
            'metodo_interrupcion_id' => 'nullable|exists:metodos_interrupcion,id',
        ]);

        DB::transaction(function() use ($request) {

            $data = $request->all();

            $data['obra_social'] = $request->has('obra_social') ? 1 : 0;
            $data['interrupcion_previa'] = $request->has('interrupcion_previa') ? 1 : 0;
            $data['violencia_previa'] = $request->has('violencia_previa') ? 1 : 0;

            $caso = IveCaso::create($data);

            if ($request->has('tipos_violencia')) {
                $caso->tiposViolencia()->sync($request->tipos_violencia);
            }

            if ($request->has('redes_contencion')) {
                $caso->redesContencion()->sync($request->redes_contencion);
            }

            if ($request->has('medicaciones')) {
                foreach ($request->medicaciones as $med) {
                    if (!empty($med['nombre'])) {
                        $caso->medicaciones()->create([
                            'nombre' => $med['nombre'],
                            'numero_lote' => $med['numero_lote'] ?? null
                        ]);
                    }
                }
            }

            $caso->load([
        'persona',
        'estadoCivil',
        'metodoInterrupcion',
        'encargado',
        'tiposViolencia',
        'redesContencion',
        'medicaciones'
    ]);

            $rutaWord = $this->generarWordIve($caso);

            $path = storage_path('app/'.$rutaWord);

            Adjunto::create([
                'entidad_tipo' => 'ive',
                'entidad_id' => $caso->id,
                'nombre_original' => basename($rutaWord),
                'nombre_guardado' => basename($rutaWord),
                'ruta' => $rutaWord,
                'tipo_mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'tamaño' => filesize($path),
                'hash_sha256' => hash_file('sha256',$path),
                'subido_por' => auth()->id(),
                'confidencial' => 0
            ]);
        });

        return redirect()
            ->route('frontend.areas.ive.listado')
            ->with('success', 'Legajo IVE creado correctamente');
    }

    public function listado()
    {
        $user = auth()->user();

        // si tiene acceso al área IVE
        if ($user->rol_id == 2 || $user->areas->contains('nombre','ive')) {

            $casos = IveCaso::with('persona')
                ->orderBy('created_at','desc')
                ->paginate(10);

        } else {

            // solo casos asignados
            $casos = $user->iveCasos()
                ->with('persona')
                ->orderBy('created_at','desc')
                ->paginate(10);
        }

        return view('frontend.areas.ive.listado', compact('casos'));
    }

   public function edit($id)
{
    $user = auth()->user();

    $caso = IveCaso::with([
        'tiposViolencia',
        'intervenciones.tipo', 
        'intervenciones.encargado',
        'redesContencion',
        'medicaciones'
    ])->findOrFail($id);

    // 🔒 CONTROL DE ACCESO

    

    $legajo = $caso;

    $personas = Persona::where('sexo', 'Femenino')->get();
    $tiposViolencia = TipoViolencia::orderBy('nombre')->get();
    $redes = RedContencion::orderBy('nombre')->get();
    $tiposIntervencion = TipoIntervencion::all();
    $estadosCiviles = EstadoCivil::orderBy('nombre')->get();
    $metodos = MetodoInterrupcion::orderBy('nombre')->get();

    $encargados = Encargado::whereHas('areas', function($q){
        $q->where('areas.id', 3);
    })->get();
                
    $existeEnGenero = DireccionGeneroCaso::where('persona_id', $caso->persona_id)->exists();

    return view('frontend.areas.ive.edit', compact(
        'caso', 
        'legajo', 
        'personas', 
        'existeEnGenero', 
        'encargados',
        'tiposViolencia',
        'redes',
        'tiposIntervencion',
        'estadosCiviles',
        'metodos'
    ));
}

  public function update(Request $request, $id)
{
    $caso = IveCaso::findOrFail($id);

    $request->validate([
        'persona_id' => 'required|exists:personas,id',
        'fum' => 'nullable|date',
        'eco_semanas' => 'nullable|integer',
        'cantidad_hijos' => 'integer|min:0',
        'alta' => 'nullable|date',
        'encargado_id' => 'required|exists:encargados,id',

        'tipos_violencia' => 'nullable|array',
        'tipos_violencia.*' => 'exists:tipos_violencia,id',

        'redes_contencion' => 'nullable|array',
        'redes_contencion.*' => 'exists:red_contencion,id',

        'medicaciones.*.nombre' => 'nullable|string|max:255',
        'medicaciones.*.numero_lote' => 'nullable|string|max:255',

        'semanas_gestacion' => 'nullable|integer|min:0',
        'estado_civil_id' => 'nullable|exists:estados_civiles,id',
        'metodo_interrupcion_id' => 'nullable|exists:metodos_interrupcion,id',
    ]);

    DB::transaction(function() use ($request, $caso) {

        $data = $request->all();

        $data['obra_social'] = $request->has('obra_social') ? 1 : 0;
        $data['interrupcion_previa'] = $request->has('interrupcion_previa') ? 1 : 0;
        $data['violencia_previa'] = $request->has('violencia_previa') ? 1 : 0;

        $caso->update($data);

        $caso->tiposViolencia()->sync($request->tipos_violencia ?? []);
        $caso->redesContencion()->sync($request->redes_contencion ?? []);

        $caso->medicaciones()->delete();

        if ($request->has('medicaciones')) {
            foreach ($request->medicaciones as $med) {
                if (!empty($med['nombre'])) {
                    $caso->medicaciones()->create([
                        'nombre' => $med['nombre'],
                        'numero_lote' => $med['numero_lote'] ?? null
                    ]);
                }
            }
        }

       $caso->load([
    'persona',
    'estadoCivil',
    'metodoInterrupcion',
    'encargado',
    'tiposViolencia',
    'redesContencion',
    'medicaciones'
]);

        $rutaWord = $this->generarWordIve($caso);

        $path = storage_path('app/'.$rutaWord);

        $adjunto = Adjunto::where('entidad_tipo','ive')
            ->where('entidad_id',$caso->id)
            ->first();

        if ($adjunto) {
            $adjunto->update([
                'tamaño' => filesize($path),
                'hash_sha256' => hash_file('sha256',$path)
            ]);
        }
    });

    return redirect()
        ->route('frontend.areas.ive.listado')
        ->with('success', 'Caso actualizado correctamente');
}
private function generarWordIve($caso)
{
    $persona = $caso->persona;

    $phpWord = new PhpWord();

    $section = $phpWord->addSection([
        'marginTop' => 1000,
        'marginBottom' => 1000,
        'marginLeft' => 1200,
        'marginRight' => 1200
    ]);

    $section->addText(
        'REGISTRO IVE',
        ['bold'=>true,'size'=>16],
        ['alignment'=>'center']
    );

    $section->addTextBreak(2);

    $table = $section->addTable([
        'borderSize'=>6,
        'borderColor'=>'999999'
    ]);

    // DATOS PERSONALES

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
    $table->addCell()->addText('Cantidad de hijos');
    $table->addCell()->addText($caso->cantidad_hijos ?? '');

    // DATOS MÉDICOS

    $table->addRow();
    $table->addCell()->addText('FUM');
    $table->addCell()->addText($caso->fum ?? '');

    $table->addRow();
    $table->addCell()->addText('Semanas de gestación');
    $table->addCell()->addText($caso->semanas_gestacion ?? '');

    $table->addRow();
    $table->addCell()->addText('Eco semanas');
    $table->addCell()->addText($caso->eco_semanas ?? '');

    $table->addRow();
    $table->addCell()->addText('Método de interrupción');
    $table->addCell()->addText($caso->metodoInterrupcion->nombre ?? '');

    // SITUACIÓN SOCIAL

    $section->addTextBreak();
    $section->addText('SITUACIÓN SOCIAL', ['bold'=>true]);

    $section->addText('Obra social: '.($caso->obra_social ? 'Sí' : 'No'));
    $section->addText('Interrupción previa: '.($caso->interrupcion_previa ? 'Sí' : 'No'));
    $section->addText('Violencia previa: '.($caso->violencia_previa ? 'Sí' : 'No'));

    // TIPOS DE VIOLENCIA

    $section->addTextBreak();
    $section->addText('TIPOS DE VIOLENCIA', ['bold'=>true]);

    foreach ($caso->tiposViolencia as $v) {
        $section->addText('- '.$v->nombre);
    }

    // REDES DE CONTENCIÓN

    $section->addTextBreak();
    $section->addText('REDES DE CONTENCIÓN', ['bold'=>true]);

    foreach ($caso->redesContencion as $r) {
        $section->addText('- '.$r->nombre);
    }

    // MEDICACIONES

    $section->addTextBreak();
    $section->addText('MEDICACIONES', ['bold'=>true]);

    foreach ($caso->medicaciones as $m) {
        $section->addText($m->nombre.'   |   Lote: '.$m->numero_lote);
    }

    // ENCARGADO

    $section->addTextBreak();
    $section->addText('Encargado: '.$caso->encargado->nombre ?? '');

    // NOMBRE DEL ARCHIVO

    $numeroCaso = str_pad($caso->id,6,"0",STR_PAD_LEFT);
    $dni = preg_replace('/[^0-9]/','',$persona->dni);

    $nombreWord = "caso_ive_{$numeroCaso}_{$dni}.docx";

    $ruta = "ive_certificados/".$nombreWord;

    $path = storage_path('app/'.$ruta);

    if(!file_exists(dirname($path))){
        mkdir(dirname($path),0755,true);
    }

    $writer = IOFactory::createWriter($phpWord,'Word2007');
    $writer->save($path);

    return $ruta;
}
}