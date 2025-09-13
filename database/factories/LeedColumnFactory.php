<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\LeedColumn;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeedColumn>
 */
class LeedColumnFactory extends Factory
{
    protected $model = LeedColumn::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
//            'user_id' => User::factory(),
            'board_id' => Board::factory(),
            'order' => $this->faker->numberBetween(1, 10),
            'can_move' => true,
            'can_delete' => false,
            'can_create' => true,
        ];
    }
}
