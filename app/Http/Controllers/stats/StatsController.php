<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Models\DireccionGeneroCaso;
use App\Models\ZonaBarrio;
use App\Models\Barrio;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\MasculinidadesCaso;
use App\Models\IveCaso;
use App\Exports\GeneroCasosExport;
use App\Exports\MasculinidadesCasosExport;
use App\Exports\IntervencionesExport;
use App\Exports\IveCasosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class StatsController extends Controller
{
    public function genero(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;

        $query = DireccionGeneroCaso::query();

        if ($desde && $hasta) {
            $query->whereBetween('created_at', [$desde, $hasta]);
        }

        $totalCasos = (clone $query)->count();

        $trabajan = (clone $query)->where('trabaja', 1)->count();
        $noTrabajan = (clone $query)->where('trabaja', 0)->count();

        $zonas = ZonaBarrio::with(['barrios' => function($q) use ($desde, $hasta) {
            $q->whereHas('direccionGeneroCasos', function($sub) use ($desde, $hasta) {
                if ($desde && $hasta) {
                    $sub->whereBetween('created_at', [$desde, $hasta]);
                }
            })
            ->withCount(['direccionGeneroCasos' => function($sub) use ($desde, $hasta) {
                if ($desde && $hasta) {
                    $sub->whereBetween('created_at', [$desde, $hasta]);
                }
            }]);
        }])->get()->map(function($zona){
            $zona->total = $zona->barrios->sum('direccion_genero_casos_count');
            return $zona;
        });

        $casosPorZona = $zonas->map(function($z){
            return [
                'nombre' => $z->nombre,
                'total' => $z->total
            ];
        });
        
        $edades = DB::table('direccion_genero_casos')
            ->join('personas', 'direccion_genero_casos.persona_id', '=', 'personas.id')
            ->select(
                DB::raw("
                    CASE
                        WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) < 18 THEN 'Menor de 18'
                        WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN '18-25'
                        WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 26 AND 35 THEN '26-35'
                        WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 36 AND 50 THEN '36-50'
                        ELSE '50+'
                    END as rango
                "),
                DB::raw('count(*) as total')
            )
            ->whereNotNull('personas.fecha_nacimiento')
            ->groupBy('rango')
            ->get();
            
        $violencias = DB::table('direccion_genero_casos')
            ->join('tipos_violencia', 'direccion_genero_casos.tipo_violencia_id', '=', 'tipos_violencia.id')
            ->select('tipos_violencia.nombre', DB::raw('count(*) as total'))
            ->groupBy('tipos_violencia.nombre')
            ->orderByDesc('total')
            ->get();

        $medidas = DB::table('direccion_genero_casos')
            ->join('medidas_cautelares', 'direccion_genero_casos.medida_cautelar_id', '=', 'medidas_cautelares.id')
            ->whereNotNull('direccion_genero_casos.medida_cautelar_id')
            ->select('medidas_cautelares.nombre', DB::raw('count(*) as total'))
            ->groupBy('medidas_cautelares.nombre')
            ->orderByDesc('total')
            ->get();

        $vinculadosMasculinidades = MasculinidadesCaso::count();
        $vinculadosIve = IveCaso::count();

        return view('frontend.stats.genero', compact(
            'totalCasos',
            'trabajan',
            'noTrabajan',
            'zonas',
            'casosPorZona',
            'desde',
            'hasta',
            'vinculadosMasculinidades',
            'vinculadosIve',
            'edades',
            'violencias',
            'medidas'
        ));
    }
    
    //exporta las estadisticas de genero
    public function exportGenero(Request $request)
    {
        return Excel::download(
            new GeneroCasosExport($request->desde, $request->hasta),
            'reporte_genero.xlsx'
        );
    }

    public function masculinidades(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;

        $query = \App\Models\MasculinidadesCaso::query();

        if ($desde && $hasta) {
            $query->whereBetween('created_at', [$desde, $hasta]);
        }

        $totalCasos = (clone $query)->count();

        $trabajan = (clone $query)->where('trabaja', 1)->count(); 
        $noTrabajan = (clone $query)->where('trabaja', 0)->count();
        $conConsumo = (clone $query)->where('consumo', 1)->count(); 
        $conTerapia = (clone $query)->where('terapia', 1)->count(); 
        $conDesobediencia = (clone $query)->where('desobediencia', 1)->count();

        $asisten = (clone $query)->whereNull('fecha_finalizacion')
                        ->where('asistencia_dispositivo', '>', 0)
                        ->count();
        $reincidencias = (clone $query)->where('reincidencia', '>', 0)->count();
        $debeDispositivo = (clone $query)->where('debe_dispositivo', 1)->count();
        $abandono = (clone $query)->whereNull('fecha_finalizacion')
                        ->where('asistencia_dispositivo', 0)
                        ->count(); 

        $finalizaron = (clone $query)->whereNotNull('fecha_finalizacion')->count(); 
        $enCurso = (clone $query)->whereNull('fecha_finalizacion')
                                ->where('asistencia_dispositivo', '>', 0)->count();

        $zonas = \App\Models\ZonaBarrio::with(['barrios' => function($q) use ($desde, $hasta) {
            $q->withCount(['personas as total_casos' => function($sub) use ($desde, $hasta) {
                $sub->whereHas('masculinidadesCasos', function($s) use ($desde, $hasta) {
                    if($desde && $hasta) $s->whereBetween('created_at', [$desde, $hasta]);
                });
            }]);
        }])->get()->map(function($zona) {
            $zona->total = $zona->barrios->sum('total_casos');
            return $zona;
        });

        $casosPorZona = $zonas->map(fn($z) => ['nombre' => $z->nombre, 'total' => $z->total]);

        $edades = DB::table('masculinidades_casos')
            ->join('personas', 'masculinidades_casos.persona_id', '=', 'personas.id')
            ->select(DB::raw("
                CASE 
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) < 18 THEN 'Menor de 18'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN '18-25'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 26 AND 40 THEN '26-40'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 41 AND 60 THEN '41-60'
                    ELSE '60+' 
                END as rango
            "), DB::raw('count(*) as total'))
            ->groupBy('rango')->get();

        $violencias = DB::table('masculinidades_caso_violencia')
            ->join('tipos_violencia', 'masculinidades_caso_violencia.tipo_violencia_id', '=', 'tipos_violencia.id')
            ->join('masculinidades_casos', 'masculinidades_caso_violencia.caso_id', '=', 'masculinidades_casos.id')
            ->select('tipos_violencia.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
                $q->whereBetween('masculinidades_casos.created_at', [$desde, $hasta]);
            })
            ->groupBy('tipos_violencia.nombre')
            ->orderByDesc('total')
            ->get();


        $medidas = DB::table('masculinidades_caso_medida')
            ->join('medidas_cautelares','masculinidades_caso_medida.medida_id','=','medidas_cautelares.id')
            ->join('masculinidades_casos','masculinidades_caso_medida.caso_id','=','masculinidades_casos.id')
            ->select('medidas_cautelares.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('masculinidades_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('medidas_cautelares.nombre')
            ->orderByDesc('total')
            ->get();

        $derivaciones = DB::table('masculinidades_casos')
            ->join('masculinidades_derivaciones','masculinidades_casos.derivacion_id','=','masculinidades_derivaciones.id')
            ->select('masculinidades_derivaciones.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('masculinidades_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('masculinidades_derivaciones.nombre')
            ->orderByDesc('total')
            ->get();

        $nivelesEducativos = DB::table('masculinidades_casos')
            ->join('niveles_estudio','masculinidades_casos.nivel_estudio_id','=','niveles_estudio.id')
            ->select('niveles_estudio.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('masculinidades_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('niveles_estudio.nombre')
            ->orderByDesc('total')
            ->get();

        return view('frontend.stats.masculinidades', compact(
            'totalCasos', 'trabajan', 'noTrabajan', 'conConsumo', 'conTerapia', 'conDesobediencia',
            'reincidencias', 'debeDispositivo', 'finalizaron', 'enCurso',
            'edades', 'zonas', 'casosPorZona', 'desde', 'hasta', 'asisten', 'abandono', 'violencias', 'medidas', 'derivaciones', 'nivelesEducativos'
        ));
    }
    //exporta estaditicas de masculinidades
    public function exportMasculinidades(Request $request)
    {
        return Excel::download(
            new MasculinidadesCasosExport($request->desde, $request->hasta),
            'reporte_masculinidades.xlsx'
        );
    }

    public function ive(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;

        $query = \App\Models\IveCaso::with('persona.barrio.zona');

        if ($desde && $hasta) {
            $query->whereBetween('created_at', [$desde, $hasta]);
        }

        $totalCasos = (clone $query)->count();

        $conObraSocial = (clone $query)->where('obra_social', 1)->count();
        $sinObraSocial = (clone $query)->where('obra_social', 0)->count();

        $conInterrupcionPrevia = (clone $query)->where('interrupcion_previa', 1)->count();

        $promedioSemanas = round((clone $query)->avg('eco_semanas'),1);

    

        $zonas = \App\Models\ZonaBarrio::with(['barrios' => function($q) use ($desde,$hasta){

            $q->whereHas('personas.casosIve', function($sub) use ($desde,$hasta){
                if($desde && $hasta){
                    $sub->whereBetween('created_at', [$desde,$hasta]);
                }
            })
            ->withCount(['personas as total_casos' => function($sub) use ($desde,$hasta){
                $sub->whereHas('casosIve', function($s) use ($desde,$hasta){
                    if($desde && $hasta){
                        $s->whereBetween('created_at', [$desde,$hasta]);
                    }
                });
            }]);

        }])->get()->map(function($zona){
            $zona->total = $zona->barrios->sum('total_casos');
            return $zona;
        });

        $edades = DB::table('ive_casos')
            ->join('personas','ive_casos.persona_id','=','personas.id')
            ->select(DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) < 18 THEN 'Menor de 18'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN '18-25'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 26 AND 35 THEN '26-35'
                    WHEN TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) BETWEEN 36 AND 45 THEN '36-45'
                    ELSE '45+'
                END as rango
            "), DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('ive_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('rango')
            ->get();
        
        $semanas = DB::table('ive_casos')
            ->select(DB::raw("
                CASE
                    WHEN semanas_gestacion <= 8 THEN '0-8'
                    WHEN semanas_gestacion BETWEEN 9 AND 12 THEN '9-12'
                    WHEN semanas_gestacion BETWEEN 13 AND 16 THEN '13-16'
                    ELSE '16+'
                END as rango
            "), DB::raw('count(*) as total'))
            ->whereNotNull('semanas_gestacion')
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('created_at',[$desde,$hasta]);
            })
            ->groupBy('rango')
            ->get();

        $estadosCiviles = DB::table('ive_casos')
            ->join('estados_civiles','ive_casos.estado_civil_id','=','estados_civiles.id')
            ->select('estados_civiles.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('ive_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('estados_civiles.nombre')
            ->orderByDesc('total')
            ->get();
        
        $metodos = DB::table('ive_casos')
            ->join('metodos_interrupcion','ive_casos.metodo_interrupcion_id','=','metodos_interrupcion.id')
            ->select('metodos_interrupcion.nombre', DB::raw('count(*) as total'))
            ->when($desde && $hasta, function($q) use ($desde,$hasta){
                $q->whereBetween('ive_casos.created_at',[$desde,$hasta]);
            })
            ->groupBy('metodos_interrupcion.nombre')
            ->orderByDesc('total')
            ->get();

        $interrupcionesPrevias = DB::table('ive_casos')
            ->select(DB::raw("
                CASE
                    WHEN interrupcion_previa = 0 THEN 'Nunca'
                    WHEN interrupcion_previa = 1 THEN 'Una vez o más'
                END as tipo
            "), DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->get();

        $casosPorZona = $zonas->map(function($z){
            return [
                'nombre' => $z->nombre,
                'total' => $z->total
            ];
        });

        return view('frontend.stats.ive', compact(
            'totalCasos',
            'conObraSocial',
            'sinObraSocial',
            'conInterrupcionPrevia',
            'promedioSemanas',
            'zonas',
            'casosPorZona',
            'desde',
            'hasta',
            'edades',
            'semanas',
            'estadosCiviles',
            'interrupcionesPrevias',
            'metodos'
        ));
    }

    //exporta estadisticas de ive
    public function exportIve(Request $request)
    {
        return Excel::download(
            new IveCasosExport($request->desde, $request->hasta),
            'reporte_ive.xlsx'
        );
    }

    public function intervenciones(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;

        $query = DB::table('intervenciones_totales');

        if ($desde && $hasta) {
            $query->whereBetween('fecha_intervencion', [$desde, $hasta]);
        }

        $totalIntervenciones = (clone $query)->count();

        $porArea = (clone $query)
            ->select('area', DB::raw('count(*) as total'))
            ->groupBy('area')
            ->get();

        $porTipo = (clone $query)
            ->join('tipos_intervencion','tipos_intervencion.id','=','intervenciones_totales.tipo_intervencion_id')
            ->select('tipos_intervencion.nombre', DB::raw('count(*) as total'))
            ->groupBy('tipos_intervencion.nombre')
            ->orderBy('total','desc')
            ->get();

        return view('frontend.stats.intervenciones', compact(
            'totalIntervenciones',
            'porArea',
            'porTipo',
            'desde',
            'hasta'
        ));
    }

    //exporta estadisticas de las intervenciones
    public function exportIntervenciones(Request $request)
    {

        return Excel::download(
            new IntervencionesExport($request->desde,$request->hasta),
            'reporte_intervenciones.xlsx'
        );
    }
}