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
                "imagen"=>'img/1.png',
                "color"=>'red'
            ],
            [
                "nombre"=>'Bebidas',
                "imagen"=>'img/2.png',
                "color"=>'blue'
            ],
        ]);
    }
}
