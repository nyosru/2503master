<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистка таблицы перед добавлением данных
        DB::table('boards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Добавление записей
        Board::factory()->create([
            'name' => 'Тестовая',
        ]);
//        Board::factory()->count(10)->create(
//            ['name' => 'тест'.rand() ]
//        );

    }
}
