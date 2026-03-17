<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{DireccionGeneroCaso, Persona, Provincia, Localidad, Barrio, EstadoCivil, NivelEstudio, IveCaso, MasculinidadesCaso, Encargado, TipoViolencia, RedContencion, TipoIntervencion,SituacionHabitacional,MedidaCautelar,Adjunto, DireccionGeneroGrupoConviviente};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
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
        ])
        ->orderBy('nivel_gravedad', 'desc')
        ->paginate(10);
        
        return view('frontend.areas.genero.listado', compact('legajos'));
    }

    public function create()
    {
        $idsConLegajo = DireccionGeneroCaso::pluck('persona_id')->toArray();
        
        $casosMasculinidades = MasculinidadesCaso::with('persona')->get();

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
            'situacionesHabitacionales',
            'casosMasculinidades'
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
        $amenazaArma = $request->has('amenaza_con_arma') ? 1 : 0;

        $trabaja = $request->has('trabaja') ? 1 : 0;
        $orgSocial = $request->has('organizacion_social') ? 1 : 0;
        $cursoMasculinidades = $request->has('debe_asistir_masculinidades') ? 1 : 0;
        
        $servicios_luz = $request->has('servicios_luz') ? 1 : 0;
        $servicios_cable = $request->has('servicios_cable') ? 1 : 0;
        $servicios_gas = $request->has('servicios_gas_natural') ? 1 : 0;
        $servicios_agua = $request->has('servicios_agua_potable') ? 1 : 0;
        $servicios_internet = $request->has('servicios_internet') ? 1 : 0;

        DB::beginTransaction();

        

        try {

            $legajo = DireccionGeneroCaso::create([
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
                'nivel_gravedad'=>$request->nivel_gravedad,
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


            if ($request->has('agresores')) {
                $legajo->agresores()->sync($request->agresores);
            }

            if ($request->has('grupo')) {

                foreach ($request->grupo as $conviviente) {

                    if (!empty($conviviente['nombre'])) {

                        DireccionGeneroGrupoConviviente::create([
                            'caso_id'  => $legajo->id,
                            'nombre'   => $conviviente['nombre'],
                            'apellido' => $conviviente['apellido'],
                            'dni'      => $conviviente['dni'] ?? null,
                            'telefono' => $conviviente['telefono'] ?? null,
                            'vinculo'  => $conviviente['vinculo'] ?? null,
                        ]);

                    }
                }

    }

            $legajo->load([
                'persona',
                'estadoCivil',
                'nivelEstudio',
                'situacionHabitacional'
            ]);

            $rutaWord = $this->generarWordGenero($legajo);

            $nombreWord = basename($rutaWord);
            $path = storage_path('app/'.$rutaWord);

            Adjunto::create([
                'entidad_tipo' => 'genero',
                'entidad_id' => $legajo->id,
                'nombre_original' => $nombreWord,
                'nombre_guardado' => $nombreWord,
                'ruta' => $rutaWord,
                'tipo_mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'tamaño' => filesize($path),
                'hash_sha256' => hash_file('sha256',$path),
                'subido_por' => auth()->id(),
                'confidencial' => 0
            ]);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }

        return redirect()->route('genero.listado')
            ->with('success','Legajo creado correctamente y documento generado');
    }
    
    private function generarWordGenero($legajo)
    {
        $persona = $legajo->persona;

        $phpWord = new PhpWord();

        $section = $phpWord->addSection([
            'marginTop' => 1000,
            'marginBottom' => 1000,
            'marginLeft' => 1200,
            'marginRight' => 1200
        ]);

        // ENCABEZADO
        $header = $section->addHeader();
        $header->addText('Municipalidad - Dirección de Género', ['bold'=>true], ['alignment'=>'center']);
        $header->addText('Registro de Caso', [], ['alignment'=>'center']);

        $section->addTextBreak(2);

        $section->addText(
            'INFORME DE CASO',
            ['bold'=>true,'size'=>16],
            ['alignment'=>'center']
        );

        $section->addTextBreak(2);

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999'
        ]);

        $table->addRow();
        $table->addCell(4000)->addText('Nombre');
        $table->addCell(6000)->addText($persona->nombre.' '.$persona->apellido);

        $table->addRow();
        $table->addCell()->addText('DNI');
        $table->addCell()->addText($persona->dni);

        $table->addRow();
        $table->addCell()->addText('Estado civil');
        $table->addCell()->addText($legajo->estadoCivil->nombre ?? '');

        $table->addRow();
        $table->addCell()->addText('Nivel de estudio');
        $table->addCell()->addText($legajo->nivelEstudio->nombre ?? '');

        $table->addRow();
        $table->addCell()->addText('Situación habitacional');
        $table->addCell()->addText($legajo->situacionHabitacional->nombre ?? '');

        $section->addTextBreak();

        $section->addText('SERVICIOS', ['bold'=>true]);

        $section->addText('Luz: '.($legajo->servicios_luz ? 'Sí':'No'));
        $section->addText('Cable: '.($legajo->servicios_cable ? 'Sí':'No'));
        $section->addText('Gas natural: '.($legajo->servicios_gas_natural ? 'Sí':'No'));
        $section->addText('Agua potable: '.($legajo->servicios_agua_potable ? 'Sí':'No'));
        $section->addText('Internet: '.($legajo->servicios_internet ? 'Sí':'No'));

        $section->addTextBreak();

        $section->addText('VIOLENCIA', ['bold'=>true]);

        $section->addText('Tipo de violencia: '.$legajo->tipo_violencia_id);
        $section->addText('Medida cautelar: '.$legajo->medida_cautelar_id);

        $section->addTextBreak();

        $section->addText('DENUNCIAS', ['bold'=>true]);

        $section->addText('Denunció antes: '.($legajo->denuncio_antes ? 'Sí':'No'));
        $section->addText('Detalle: '.$legajo->denuncio_antes_detalle);
        $section->addText('Fecha última denuncia: '.$legajo->fecha_ultima_denuncia);

        $section->addTextBreak();

        $section->addText('OBSERVACIONES', ['bold'=>true]);
        $section->addText($legajo->observaciones ?? '');

        $numeroCaso = str_pad($legajo->id,6,"0",STR_PAD_LEFT);
        $dni = preg_replace('/[^0-9]/','',$persona->dni);

        $nombreWord = "caso_genero_{$numeroCaso}_{$dni}.docx";

        // 🔹 CARPETA CORRECTA
        $ruta = "genero_certificados/".$nombreWord;

        $path = storage_path('app/'.$ruta);

        if(!file_exists(dirname($path))){
            mkdir(dirname($path),0755,true);
        }

        $writer = IOFactory::createWriter($phpWord,'Word2007');
        $writer->save($path);

        return $ruta;
    }
    public function descargarWord($id)
    {
        $caso = DireccionGeneroCaso::findOrFail($id);

        $user = auth()->user();

        if (
            $user->rol_id != 2 &&
            !$user->areas->contains('nombre','direccion_genero')
        ) {
            abort(403);
        }

        $adjunto = Adjunto::where('entidad_tipo','genero')
            ->where('entidad_id',$caso->id)
            ->firstOrFail();

        return Storage::download($adjunto->ruta, $adjunto->nombre_original);
    }
    public function edit($id)
    {
        $legajo = DireccionGeneroCaso::with([
            'persona',
            'intervenciones.tipo',
            'intervenciones.encargado',
            'intervenciones.adjunto',
            'grupoConviviente'
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

        
        if ($request->has('grupo')) {
            $legajo->grupoConviviente()->delete();
            foreach ($request->grupo as $conviviente) {
                if (!empty($conviviente['nombre'])) {
                    $legajo->grupoConviviente()->create([
                        'nombre'   => $conviviente['nombre'],
                        'apellido' => $conviviente['apellido'] ?? null,
                        'dni'      => $conviviente['dni'] ?? null,
                        'telefono' => $conviviente['telefono'] ?? null,
                        'vinculo'  => $conviviente['vinculo'] ?? null,
                    ]);
                    }
                    }
                    }
                    
        try {
            DB::beginTransaction();


            $legajo->update([
                'persona_id' => $request->persona_id,
                'estado_civil_id' => $request->estado_civil_id,
                'genero' => $request->genero,
                'provincia_id' => $request->provincia_id,
                'localidad_id' => $request->localidad_id,
                'barrio_id' => $request->barrio_id,
                'nivel_estudio_id' => $request->nivel_estudio_id,
                'nivel_gravedad'=>$request->nivel_gravedad,
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

            $legajo->load([
                'persona',
                'estadoCivil',
                'nivelEstudio',
                'situacionHabitacional'
            ]);

            $rutaWord = $this->generarWordGenero($legajo);

            $path = storage_path('app/'.$rutaWord);

            $adjunto = Adjunto::where('entidad_tipo','genero')
                ->where('entidad_id',$legajo->id)
                ->first();

            if ($adjunto) {
                $adjunto->update([
                    'tamaño' => filesize($path),
                    'hash_sha256' => hash_file('sha256',$path)
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            throw $e;

        }

        return redirect()->route('genero.listado')
            ->with('success','Legajo actualizado y documento regenerado.');
    }


    public function destroy(Request $request, $id)
    {
        // 1. Validar que llegue el motivo
        $request->validate([
            'motivo_eliminacion' => 'required|string|min:10'
        ]);

        $legajo = DireccionGeneroCaso::findOrFail($id);

        // 2. Registrar rastro antes de eliminar
        $legajo->deleted_by = auth()->id();
        $legajo->motivo_eliminacion = $request->motivo_eliminacion;
        $legajo->save();

        // 3. Eliminar (Soft Delete)
        $legajo->delete();

        return redirect()->route('genero.listado')
            ->with('success', 'El legajo ha sido enviado a la papelera correctamente.');
    }
}