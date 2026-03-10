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

    public function masculinidades(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;

        $query = \App\Models\MasculinidadesCaso::with('persona.barrio.zona');

        if ($desde && $hasta) {
            $query->whereBetween('created_at', [$desde, $hasta]);
        }

        $totalCasos = (clone $query)->count();

        $trabajan = (clone $query)->where('trabaja', 1)->count();
        $noTrabajan = (clone $query)->where('trabaja', 0)->count();

        $conConsumo = (clone $query)->where('consumo', 1)->count();
        $conDesobediencia = (clone $query)->where('desobediencia', 1)->count();

        $zonas = \App\Models\ZonaBarrio::with(['barrios' => function($q) use ($desde,$hasta){
            $q->whereHas('personas.masculinidadesCasos', function($sub) use ($desde,$hasta){
                if($desde && $hasta){
                    $sub->whereBetween('created_at', [$desde,$hasta]);
                }
            })
            ->withCount(['personas as total_casos' => function($sub) use ($desde,$hasta){
                $sub->whereHas('masculinidadesCasos', function($s) use ($desde,$hasta){
                    if($desde && $hasta){
                        $s->whereBetween('created_at', [$desde,$hasta]);
                    }
                });
            }]);
        }])->get()->map(function($zona){
            $zona->total = $zona->barrios->sum('total_casos');
            return $zona;
        });

        $casosPorZona = $zonas->map(function($z){
            return [
                'nombre' => $z->nombre,
                'total' => $z->total
            ];
        });

        return view('frontend.stats.masculinidades', compact(
            'totalCasos',
            'trabajan',
            'noTrabajan',
            'conConsumo',
            'conDesobediencia',
            'zonas',
            'casosPorZona',
            'desde',
            'hasta'
        ));
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
            'hasta'
        ));
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
}