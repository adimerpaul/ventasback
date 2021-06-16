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
                "nombre"=>'LOMO SALTEADO',
                "imagen"=>'img/3.png',
                "color"=>'red',
                "precio"=>'35.00',
                "descripcion"=>'Contiene ingredientes arroz papa',
                "rubro_id"=>'1',
            ],
            [
                "nombre"=>'AEROPUERTO',
                "imagen"=>'img/4.png',
                "color"=>'green',
                "precio"=>'30.00',
                "descripcion"=>'Contiene ingredientes arroz papa',
                "rubro_id"=>'1',
            ],
            [
                "nombre"=>'CHICHA MORADA',
                "imagen"=>'img/5.png',
                "color"=>'blue',
                "precio"=>'5.00',
                "descripcion"=>'Jugo morado',
                "rubro_id"=>'2',
            ],
        ]);
//        $table->decimal('precio',11,2);
//        $table->string('imagen');
//        $table->string('color');
//        $table->string('descripcion');
//        $table->boolean('activo');
    }
}
