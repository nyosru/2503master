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
        Schema::table('users', function (Blueprint $table) {
            // Добавляем поле current_board_id
            $table->foreignId('current_board_id')
                ->nullable() // Поле может быть NULL
                ->constrained('boards') // Связь с таблицей boards
                ->onDelete('set null'); // При удалении доски поле станет NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Удаляем поле current_board_id
            $table->dropForeign(['current_board_id']);
            $table->dropColumn('current_board_id');
        });
    }
};
