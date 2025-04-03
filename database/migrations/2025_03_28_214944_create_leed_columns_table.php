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
        Schema::create('leed_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // varchar(255) NOT NULL
            $table->unsignedBigInteger('board_id');
            $table->boolean('can_move')->default(true); // tinyint(1) NOT NULL DEFAULT 1
            $table->boolean('can_delete')->default(true); // tinyint(1) NOT NULL DEFAULT 1
            $table->unsignedInteger('order')->default(0); // int(10) UNSIGNED NOT NULL DEFAULT 0
            $table->boolean('type_otkaz')->default(false); // tinyint(1) NOT NULL DEFAULT 0
            $table->boolean('can_transfer')->default(false); // tinyint(1) NOT NULL DEFAULT 0
            $table->boolean('can_create')->default(false); // tinyint(1) NOT NULL DEFAULT 0
            $table->softDeletes(); // Добавляет столбец `deleted_at` для мягкого удаления
            $table->timestamps();


            // Внешние ключи
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
//                ->onDelete('cascade')
            ;

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_columns');
    }
};
