<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                "nombre"=>'Lomo salteado',
                "imagen"=>'lomo.png',
                "color"=>'red',
                "precio"=>'35.00',
                "descripcion"=>'Contiene ingredientes arroz papa',
                "rubro_id"=>'1',
                "cantidad"=>'15',
            ],
            [
                "nombre"=>'Aeropuerto',
                "imagen"=>'aeropuerto.png',
                "color"=>'green',
                "precio"=>'30.00',
                "descripcion"=>'Contiene ingredientes arroz papa',
                "rubro_id"=>'1',
                "cantidad"=>'15',
            ],
            [
                "nombre"=>'Chicha morada',
                "imagen"=>'chicha.png',
                "color"=>'blue',
                "precio"=>'5.00',
                "descripcion"=>'Jugo morado',
                "rubro_id"=>'2',
                "cantidad"=>'15',
            ],

        ]);
//        $table->decimal('precio',11,2);
//        $table->string('imagen');
//        $table->string('color');
//        $table->string('descripcion');
//        $table->boolean('activo');
    }
}
