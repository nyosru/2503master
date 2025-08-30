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
        Schema::create('board_user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('setting'); // название настройки
            $table->integer('numeric_value')->nullable(); // числовое значение
            $table->string('string_value')->nullable(); // строковое значение
            $table->timestamps();

            // Уникальный индекс для предотвращения дублирования настроек
            $table->unique(['board_id', 'user_id', 'setting']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_user_settings');
    }
};
