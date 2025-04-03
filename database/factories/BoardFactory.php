<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
//            'guard_name' => 'web',
//            'sort' => $this->faker->numberBetween(1, 100),
            'is_paid' => false,
            'deleted_at' => NULL,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
