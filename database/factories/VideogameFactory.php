<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Videogame>
 */
class VideogameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(),
            'cover' => $this->faker->imageUrl(200, 200, 'games'), // URL de imagen aleatoria
        ];
    }
}
