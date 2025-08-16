<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'eng_name' => $this->faker->name(),
            'type' => 'movie',
            'movieLength' => $this->faker->numberBetween(5 , 90),
            'route_to_film' => 'path',
            'age_rating' => $this->faker->numberBetween(7,21),
            'preview_url'=> 'url',
            'genres_id' => 1,
            'user_published'=>1,
            'description' => $this->faker->text(180),
            'preview' => 'preview',
            'year' => '2025-08-01',
            'shortDescription' => $this->faker->text(20),
        ];
    }
}
