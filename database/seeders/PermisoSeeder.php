<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            ['id'=>1,'nombre'=>'Menu Dosificacion'],
            ['id'=>2,'nombre'=>'Crear Dosificacion'],
            ['id'=>3,'nombre'=>'Modificar Dosificacion'],
            ['id'=>4,'nombre'=>'Eliminar Dosificacion'],
            ['id'=>5,'nombre'=>'Menu Rubro'],
            ['id'=>6,'nombre'=>'Crear Rubro'],
            ['id'=>7,'nombre'=>'Modificar Rubro'],
            ['id'=>8,'nombre'=>'Eliminar Rubro'],
            ['id'=>9,'nombre'=>'Menu Producto'],
            ['id'=>10,'nombre'=>'Crear Producto'],
            ['id'=>11,'nombre'=>'Modificar Producto'],
            ['id'=>12,'nombre'=>'Eliminar Producto'],
            ['id'=>13,'nombre'=>'Menu Usuarios'],
            ['id'=>14,'nombre'=>'Crear Usuarios'],
            ['id'=>15,'nombre'=>'Modificar Usuarios'],
            ['id'=>16,'nombre'=>'Eliminar Usuarios'],
            ['id'=>17,'nombre'=>'Menu Clientes'],
            ['id'=>18,'nombre'=>'Crear Clientes'],
            ['id'=>19,'nombre'=>'Modificar Clientes'],
            ['id'=>20,'nombre'=>'Eliminar Clientes'],
            ['id'=>21,'nombre'=>'Menu Venta'],
            ['id'=>22,'nombre'=>'Crear Venta'],
            ['id'=>23,'nombre'=>'Anular Venta'],
            ['id'=>24,'nombre'=>'Menu Reportes'],
            ['id'=>25,'nombre'=>'Menu Deliveri'],
            ['id'=>26,'nombre'=>'Modificar Deliveri'],
            ['id'=>27,'nombre'=>'Resumen dia'],
            ['id'=>28,'nombre'=>'Grafica productos'],
        ]);
    }
}
