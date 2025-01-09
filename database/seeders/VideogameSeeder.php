<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Videogame;

class VideogameSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 20 registros falsos en la tabla videogames
        Videogame::factory(20)->create();
    }
}
