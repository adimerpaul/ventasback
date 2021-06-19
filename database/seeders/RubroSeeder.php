<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rubros')->insert([
            [
                "nombre"=>'Platos',
                "imagen"=>'comida.png',
                "color"=>'red'
            ],
            [
                "nombre"=>'Bebidas',
                "imagen"=>'bebida.png',
                "color"=>'blue'
            ],
        ]);
    }
}
