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
                "nrotramite"=>'1',
                "nroautorizacion"=>'278801600000494',
                "nrofactini"=>2298,
                "llave"=>'Rj229Pj+iPnB@D$U{cS[f-U*k5D@CsI4(2]M$$RWn2GF%PaDbaVVxSLd-wBsLbGE',
                "desde"=>'2021-06-15',
                "hasta"=>'2021-12-31',
                "leyenda"=>'Ley N° 453: Tienes derecho a un trato equitativo sin discriminacion en la oferta de servicios.',
                "activo"=>1,
                "nrofactura"=>2298,
                "empresa_id"=>1,
            ]
            ]);
    }
}
