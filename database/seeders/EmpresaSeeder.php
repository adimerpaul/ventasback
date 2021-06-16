<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            [
                "nombre"=>'Sabor Peru',
                "nit"=>'1010',
                "telefono"=>'1010',
                "direccion"=>'avenida tacna',
            ]
        ]);
    }
}
