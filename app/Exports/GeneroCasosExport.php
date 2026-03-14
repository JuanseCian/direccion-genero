<?php

namespace App\Exports;

use App\Models\DireccionGeneroCaso;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneroCasosExport implements FromCollection, WithHeadings
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
        $query = DB::table('direccion_genero_casos')
            ->join('personas','direccion_genero_casos.persona_id','=','personas.id')
            ->leftJoin('barrio','personas.barrio_id','=','barrio.id')
            ->leftJoin('zona_barrio','barrio.zona_barrio_id','=','zona_barrio.id')
            ->leftJoin('tipos_violencia','direccion_genero_casos.tipo_violencia_id','=','tipos_violencia.id')
            ->leftJoin('medidas_cautelares','direccion_genero_casos.medida_cautelar_id','=','medidas_cautelares.id')
            ->select(
                'direccion_genero_casos.id as Caso',
                'personas.nombre',
                'personas.apellido',
                'personas.dni',
                DB::raw("TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) as edad"),
                'barrio.nombre as barrio',
                'zona_barrio.nombre as zona',
                'tipos_violencia.nombre as tipo_violencia',
                'medidas_cautelares.nombre as medida_cautelar',
                DB::raw("IF(direccion_genero_casos.trabaja=1,'SI','NO') as trabaja"),
                'direccion_genero_casos.created_at as fecha_registro'
            );

        if ($this->desde && $this->hasta) {
            $query->whereBetween('direccion_genero_casos.created_at', [$this->desde, $this->hasta]);
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
            'Tipo Violencia',
            'Medida Cautelar',
            'Trabaja',
            'Fecha Registro'
        ];
    }
}