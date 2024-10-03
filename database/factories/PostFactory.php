<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //datos de la tabla posts
            'titulo' => fake()->sentence(5),
            'descripcion' => fake()->paragraph(2),
            'imagen' => fake() ->uuid() . '.jpg',
            'user_id' => fake()->randomElement([3, 4, 5, 6, 7]), 
        ];
    }
}
