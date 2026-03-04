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
            'vinculadosIve'
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
}