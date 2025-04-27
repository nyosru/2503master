<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'board_id' => 1,
                'user_id' => 2,
                'role_id' => 2,
                'deleted_at' => null,
                'created_at' => '2025-04-26 08:58:14',
                'updated_at' => '2025-04-26 08:58:14',
            ],
            [
                'id' => 2,
                'board_id' => 1,
                'user_id' => 3,
                'role_id' => 1,
                'deleted_at' => null,
                'created_at' => '2025-04-26 08:58:23',
                'updated_at' => '2025-04-26 08:58:23',
            ],
        ];

        // Вставляем данные в таблицу
        DB::table('board_users')->insert($data);
    }
}
