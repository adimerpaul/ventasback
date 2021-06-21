<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'cinit'=>'1010',
                'nombrerazon'=>'JUAN PEREZ',
            ],
            [
                'cinit'=>'7336199',
                'nombrerazon'=>'ADIMER PAUL CHAMBI AJATA',
            ],
        ]);
    }
}
