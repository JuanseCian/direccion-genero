<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasculinidadesCasosExport implements FromCollection, WithHeadings
{
    protected $desde;
    protected $hasta;

    public function __construct($desde, $hasta)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
    }

    public function collection()
    {
        $query = DB::table('masculinidades_casos')
            ->join('personas','masculinidades_casos.persona_id','=','personas.id')
            ->leftJoin('barrio','personas.barrio_id','=','barrio.id')
            ->leftJoin('zona_barrio','barrio.zona_barrio_id','=','zona_barrio.id')
            ->leftJoin('masculinidades_derivaciones','masculinidades_casos.derivacion_id','=','masculinidades_derivaciones.id')
            ->leftJoin('niveles_estudio','masculinidades_casos.nivel_estudio_id','=','niveles_estudio.id')
            ->select(
                'masculinidades_casos.id as Caso',
                'personas.nombre',
                'personas.apellido',
                'personas.dni',
                DB::raw("TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) as edad"),
                'barrio.nombre as barrio',
                'zona_barrio.nombre as zona',
                'masculinidades_derivaciones.nombre as derivacion',
                'niveles_estudio.nombre as nivel_educativo',
                DB::raw("IF(masculinidades_casos.trabaja=1,'SI','NO') as trabaja"),
                DB::raw("IF(masculinidades_casos.consumo=1,'SI','NO') as consumo"),
                DB::raw("IF(masculinidades_casos.terapia=1,'SI','NO') as terapia"),
                DB::raw("IF(masculinidades_casos.desobediencia=1,'SI','NO') as desobediencia"),
                'masculinidades_casos.reincidencia',
                'masculinidades_casos.asistencia_dispositivo',
                'masculinidades_casos.fecha_finalizacion',
                'masculinidades_casos.created_at as fecha_ingreso'
            );

        if ($this->desde && $this->hasta) {
            $query->whereBetween('masculinidades_casos.created_at', [$this->desde, $this->hasta]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Caso',
            'Nombre',
            'Apellido',
            'DNI',
            'Edad',
            'Barrio',
            'Zona',
            'Derivación',
            'Nivel Educativo',
            'Trabaja',
            'Consumo',
            'Terapia',
            'Desobediencia',
            'Reincidencias',
            'Asistencia Dispositivo',
            'Fecha Finalización',
            'Fecha Ingreso'
        ];
    }
}