<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosages')->insert([
            [
                "nrotramite"=>'400001984457',
                "nroautorizacion"=>'332401900008210',
                "nrofactini"=>1,
                "llave"=>'38@#I#(Z95qd-@=2ja2JLFUUN)G6GBWCZE#-SVEDHgtQBh@qV_UHPqXSEvnCZJBB',
                "desde"=>'2021-06-15',
                "hasta"=>'2021-12-31',
                "leyenda"=>'Ley N° 453: Tienes derecho a un trato equitativo sin discriminacion en la oferta de servicios.',
                "activo"=>1,
                "nrofactura"=>1,
                "empresa_id"=>1,
            ]
//            $table->string('nrotramite');
//            $table->string('nroautorizacion');
//            $table->string('nrofactini');
//            $table->string('llave');
//            $table->date('desde');
//            $table->date('hasta');
//            $table->string('leyenda');
//            $table->boolean('activo');
//            $table->string('nroFactura');
        ]);
    }
}
