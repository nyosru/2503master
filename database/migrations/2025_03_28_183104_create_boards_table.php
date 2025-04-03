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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Название доски
//            $table->unsignedBigInteger('user_id'); // Пользователь
            $table->boolean('is_paid')->default(false); // Оплачено или нет (по умолчанию false)
            $table->softDeletes(); // Добавляет created_at и updated_at
            $table->timestamps(); // Добавляет created_at и updated_at

//            // Внешний ключ для user_id
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
////                ->onDelete('cascade')
//            ;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
