<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email'=>'saborperu@test.com',
                'name'=>'saborperu',
                'empresa_id'=>1,
                'password'=>Hash::make('Admin@2021'),
            ],
        ]);
    }
}
