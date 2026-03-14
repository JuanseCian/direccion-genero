<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IntervencionesExport implements FromCollection, WithHeadings
{
    protected $desde;
    protected $hasta;

    public function __construct($desde,$hasta)
    {
        $this->desde=$desde;
        $this->hasta=$hasta;
    }

    public function collection()
    {

        /*
        INTERVENCIONES GENERO
        */

        $genero = DB::table('direccion_genero_intervenciones as di')

        ->join('direccion_genero_casos as c','di.caso_id','=','c.id')
        ->join('personas as p','c.persona_id','=','p.id')
        ->leftJoin('tipos_intervencion as t','di.tipo_intervencion_id','=','t.id')
        ->leftJoin('encargados as e','di.encargado_id','=','e.id')

        ->select(

            DB::raw("'Genero' as area"),

            'di.id',
            't.nombre as tipo_intervencion',
            'p.nombre',
            'p.apellido',
            'p.dni',

            DB::raw("TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) as edad"),

            'e.nombre as encargado',

            'di.fecha_intervencion',

            'di.detalle'

        );


        /*
        INTERVENCIONES MASCULINIDADES
        */

        $masculinidades = DB::table('masculinidades_intervenciones as mi')

        ->join('masculinidades_casos as c','mi.caso_id','=','c.id')
        ->join('personas as p','c.persona_id','=','p.id')
        ->leftJoin('tipos_intervencion as t','mi.tipo_intervencion_id','=','t.id')
        ->leftJoin('encargados as e','mi.encargado_id','=','e.id')

        ->select(

            DB::raw("'Masculinidades' as area"),

            'mi.id',
            't.nombre as tipo_intervencion',
            'p.nombre',
            'p.apellido',
            'p.dni',

            DB::raw("TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) as edad"),

            'e.nombre as encargado',

            'mi.fecha_intervencion',

            'mi.detalle'

        );


        /*
        INTERVENCIONES IVE
        */

        $ive = DB::table('ive_intervenciones as ii')

        ->join('ive_casos as c','ii.ive_caso_id','=','c.id')
        ->join('personas as p','c.persona_id','=','p.id')
        ->leftJoin('tipos_intervencion as t','ii.tipo_intervencion_id','=','t.id')
        ->leftJoin('encargados as e','ii.encargado_id','=','e.id')

        ->select(

            DB::raw("'IVE' as area"),

            'ii.id',
            't.nombre as tipo_intervencion',
            'p.nombre',
            'p.apellido',
            'p.dni',

            DB::raw("TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) as edad"),

            'e.nombre as encargado',

            'ii.fecha_intervencion',

            'ii.detalle'

        );


        /*
        UNION DE TODAS
        */

        $query = $genero
        ->union($masculinidades)
        ->union($ive);


        $resultados = DB::query()
        ->fromSub($query,'intervenciones');


        if($this->desde && $this->hasta){

            $resultados->whereBetween('fecha_intervencion',[
                $this->desde,
                $this->hasta
            ]);

        }

        return $resultados
        ->orderBy('fecha_intervencion','desc')
        ->get();

    }

    public function headings(): array
    {
        return [

        'Area',
        'ID',
        'Tipo Intervencion',
        'Nombre',
        'Apellido',
        'DNI',
        'Edad',
        'Encargado',
        'Fecha',
        'Detalle'

        ];
    }
}