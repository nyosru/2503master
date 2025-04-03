<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
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
            'guard_name' => 'web',
            'sort' => $this->faker->numberBetween(1, 100),
            'deleted_at' => NULL,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
