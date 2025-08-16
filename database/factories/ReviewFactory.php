<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'review'=> $this->faker->text(100),
            'rating'=> $this->faker->numberBetween(1,5),
            'user_id'=> $this->faker->numberBetween(1,10),
            'movie_id'=> $this->faker->numberBetween(1,10),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
