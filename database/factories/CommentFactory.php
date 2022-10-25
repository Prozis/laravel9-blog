<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => rand(1, 15),
            'name' => fake()->name(),
            'text' => fake()->realTextBetween(5, 50),
            'created_at' => fake()->dateTimeBetween('-90 days ', '-2 days'),
            'updated_at' => fake()->dateTimeBetween('-60 days ', '-1 days'),
        ];
    }
}
