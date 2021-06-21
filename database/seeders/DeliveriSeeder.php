<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveris')->insert([
            ['nombre'=>'dingo',],
            ['nombre'=>'yaigo',],
            ['nombre'=>'pedidosya',],
        ]);
    }
}
