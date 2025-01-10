<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideogameSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 20 registros falsos en la tabla videogames
        //Videogame::factory(5)->create();
        DB::table('videogames')->insert([

            'name'=>'Valorant',
            'description'=> 'Descripcion para Juego 1',
            'cover'=>'https://placehold.co/75x75',
            'user_id'=> '1'
        ]);
        DB::table('videogames')->insert([

            'name'=>'Call of Duty',
            'description'=> 'Descripcion para Juego 2',
            'cover'=>'https://placehold.co/75x75',
            'user_id'=> '1'

        ]);
        DB::table('videogames')->insert([

            'name'=>'Warzone',
            'description'=> 'Descripcion para Juego 3',
            'cover'=>'https://placehold.co/75x75',
            'user_id'=> '2'

        ]);
    }
}
