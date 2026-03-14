<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IveCasosExport implements FromCollection, WithHeadings
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
        $query = DB::table('ive_casos')
            ->join('personas','ive_casos.persona_id','=','personas.id')
            ->leftJoin('barrio','personas.barrio_id','=','barrio.id')
            ->leftJoin('zona_barrio','barrio.zona_barrio_id','=','zona_barrio.id')
            ->leftJoin('estados_civiles','ive_casos.estado_civil_id','=','estados_civiles.id')
            ->select(
                'ive_casos.id as caso',
                'personas.nombre',
                'personas.apellido',
                'personas.dni',
                DB::raw("TIMESTAMPDIFF(YEAR, personas.fecha_nacimiento, CURDATE()) as edad"),
                'estados_civiles.nombre as estado_civil',
                'barrio.nombre as barrio',
                'zona_barrio.nombre as zona',
                'ive_casos.semanas_gestacion',
                DB::raw("IF(ive_casos.obra_social=1,'SI','NO') as obra_social"),
                DB::raw("IF(ive_casos.interrupcion_previa=1,'SI','NO') as interrupcion_previa"),
                'ive_casos.created_at as fecha_atencion'
            );

        if ($this->desde && $this->hasta) {
            $query->whereBetween('ive_casos.created_at', [$this->desde, $this->hasta]);
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
            'Estado Civil',
            'Barrio',
            'Zona',
            'Semanas Gestación',
            'Obra Social',
            'Interrupción Previa',
            'Fecha Atención'
        ];
    }
}