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
                "nrotramite"=>'400003153414',
                "nroautorizacion"=>'384401110196992',
                "nrofactini"=>1,
                "llave"=>'2+ZA+aCN3Nyw7rVUWDCu-6wnK-CRpPBG[+8+T4_Zz]a=cAJu-#B-h\PVY=E[KMG%',
                "desde"=>'2021-07-21',
                "hasta"=>'2022-01-17',
                "leyenda"=>'Ley N° 453: El proveedor debe exhibir certificaciones de habilitación o documentos que acrediten las capacidades u ofertas de servicios
especializados.',
                "activo"=>1,
                "nrofactura"=>1,
                "empresa_id"=>1,
            ]
            ]);
    }
}
