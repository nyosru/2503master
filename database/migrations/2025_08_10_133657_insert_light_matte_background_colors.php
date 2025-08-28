<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Вставляем несколько светлых матовых цветов
        DB::table('leed_column_background_colors')->insert([
            ['name' => 'серый', 'html_code' => '#DDDDDD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'белый', 'html_code' => '#FFFFFF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-голубой', 'html_code' => '#A3C1D1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-зеленый', 'html_code' => '#B8D8B8', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-желтый', 'html_code' => '#FFF5BA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-розовый', 'html_code' => '#F7D1CD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-серый', 'html_code' => '#D6D6D6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-бежевый', 'html_code' => '#EBD9C6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'светло-лавандовый', 'html_code' => '#C9C1E7', 'created_at' => now(), 'updated_at' => now()],
       ]);
        DB::table('leed_column_background_colors')->insert([
            ['name' => 'из жёлтого в синий', 'tailwind_classes' => 'bg-gradient-to-r from-yellow-100 to-blue-200', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'из красного в синий', 'tailwind_classes' => 'bg-gradient-to-r from-red-100 to-blue-200',
                'created_at' => now(), 'updated_at' => now()],
            ['name' => 'из жёлтого в белый', 'tailwind_classes' => 'bg-gradient-to-r from-yellow-100 to-white', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'из белого в синий', 'tailwind_classes' => 'bg-gradient-to-r from-white to-blue-200', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Удаляем эти цвета по названиям
        DB::table('leed_column_background_colors')
            ->whereIn('name', [
                'серый',

                'из жёлтого в синий',
                 'из красного в синий',
                'из жёлтого в белый',
                 'из белого в синий',

                'белый',
                'светло-голубой',
                'светло-зеленый',
                'светло-желтый',
                'светло-розовый',
                'светло-серый',
                'светло-бежевый',
                'светло-лавандовый',
            ])
            ->delete();
    }
};
