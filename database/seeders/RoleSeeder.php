<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['id'=>1,'nombre'=>'usuario','descripcion'=>'Carga de datos'],
            ['id'=>2,'nombre'=>'administrador','descripcion'=>'Gestiona usuarios'],
            ['id'=>3,'nombre'=>'inactivo','descripcion'=>'Sin acceso'],
            ['id'=>4,'nombre'=>'programador','descripcion'=>'Acceso total sistema'],
        ]);
    }
}
