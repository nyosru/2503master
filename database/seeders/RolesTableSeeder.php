<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистка таблицы перед добавлением данных
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Добавление записей
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Менеджер',
                'board_id' => 1,
                'guard_name' => 'web',
                'created_at' => '2025-03-30 14:44:09',
                'updated_at' => '2025-03-30 14:44:09',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Руководитель',
                'board_id' => 1,
                'guard_name' => 'web',
                'created_at' => '2025-03-30 14:44:21',
                'updated_at' => '2025-03-30 14:44:21',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'Тех.поддержка',
                'board_id' => 1,
                'guard_name' => 'web',
                'created_at' => '2025-03-30 14:45:00',
                'updated_at' => '2025-03-30 14:45:00',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'name' => 'Доставщик',
                'board_id' => 1,
                'guard_name' => 'web',
                'created_at' => '2025-03-30 14:45:51',
                'updated_at' => '2025-03-30 14:45:51',
                'deleted_at' => null,
            ],
        ]);
    }
}
