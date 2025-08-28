<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->text(1000),
            'image' => $this->faker->optional()->imageUrl(800, 400, 'business', true),
            'author_user_id' => User::factory(),
            'is_published' => $this->faker->boolean(80),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }


    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }



}
