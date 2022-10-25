<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $title = fake()->realTextBetween(5, 50);
        return [
            'title' => $title,
            'short_title' => mb_strlen($title) > 30 ? mb_substr($title, 0, 30) . ' ...' : $title,
            'author_id' => rand(1, 4),
            'descr' => fake()->realTextBetween(100, 1500),
            'created_at' => fake()->dateTimeBetween('-90 days ', '-2 days'),
            'updated_at' => fake()->dateTimeBetween('-60 days ', '-1 days'),
        ];
    }
}
