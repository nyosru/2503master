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
        Schema::create('order_requests_renames', function (Blueprint $table) {
            $table->id();

            // Связь с доской
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
                ->onDelete('cascade');

            // Связь с заявкой
            $table->unsignedBigInteger('order_requests_id');
            $table->foreign('order_requests_id')
                ->references('id')
                ->on('order_requests')
                ->onDelete('cascade');

            // Данные для переименования
            $table->string('name');         // Новое название поля
            $table->string('description');    // Новое описание поля

            $table->timestamps();

            // Уникальность: одна запись на доску + заявку
            $table->unique(['board_id', 'order_requests_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_requests_renames');
    }
};
