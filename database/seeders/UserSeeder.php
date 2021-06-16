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
                'email'=>'admin@test.com',
                'name'=>'admin',
                'empresa_id'=>1,
                'password'=>Hash::make('admin'),
            ],
            [
                'email'=>'saborperu@test.com',
                'name'=>'saborperu',
                'empresa_id'=>1,
                'password'=>Hash::make('admin'),
            ],
        ]);
    }
}
