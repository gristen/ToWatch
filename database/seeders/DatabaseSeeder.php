<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            GenreSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            MovieSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
