<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leed_column_color_assignments', function (Blueprint $table) {
            $table->id();

            // Внешний ключ на колонку в таблице leed_columns
            $table->foreignId('leed_column_id')->constrained()->cascadeOnDelete();

            // Внешний ключ на цвет из таблицы leed_column_background_colors
            $table->foreignId('background_color_id')->constrained('leed_column_background_colors')->cascadeOnDelete();

            $table->timestamps();

            // Чтобы одна колонка могла иметь только один конкретный назначенный цвет
            $table->unique('leed_column_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_column_color_assignments');
    }
};
