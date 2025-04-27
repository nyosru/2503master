<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeedColumnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Первая',
                'board_id' => 1,
                'can_move' => 1,
                'can_delete' => 1,
                'order' => 3,
                'type_otkaz' => 0,
                'can_transfer' => 0,
                'can_create' => 1,
                'deleted_at' => null,
                'created_at' => '2025-04-26 09:11:11',
                'updated_at' => '2025-04-26 09:11:59',
            ],
            [
                'id' => 2,
                'name' => 'Вторая столбец',
                'board_id' => 1,
                'can_move' => 1,
                'can_delete' => 1,
                'order' => 5,
                'type_otkaz' => 0,
                'can_transfer' => 0,
                'can_create' => 0,
                'deleted_at' => null,
                'created_at' => '2025-04-26 09:11:23',
                'updated_at' => '2025-04-26 09:11:23',
            ],
            [
                'id' => 3,
                'name' => 'Финиш',
                'board_id' => 1,
                'can_move' => 1,
                'can_delete' => 1,
                'order' => 7,
                'type_otkaz' => 0,
                'can_transfer' => 0,
                'can_create' => 0,
                'deleted_at' => null,
                'created_at' => '2025-04-26 09:11:37',
                'updated_at' => '2025-04-26 09:11:37',
            ],
            [
                'id' => 4,
                'name' => 'Отказ',
                'board_id' => 1,
                'can_move' => 1,
                'can_delete' => 1,
                'order' => 9,
                'type_otkaz' => 0,
                'can_transfer' => 0,
                'can_create' => 0,
                'deleted_at' => null,
                'created_at' => '2025-04-26 09:11:49',
                'updated_at' => '2025-04-26 09:11:49',
            ],
        ];

        DB::table('leed_columns')->insert($data);
    }
}
