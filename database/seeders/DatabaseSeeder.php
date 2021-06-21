<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
           EmpresaSeeder::class,
            UserSeeder::class,
            DosageSeeder::class,
            RubroSeeder::class,
            ProductSeeder::class,
            PermisoSeeder::class,
            UsuariopermisoSeeder::class,
            ClientSeeder::class,
            DeliveriSeeder::class,
        ]);
    }
}
