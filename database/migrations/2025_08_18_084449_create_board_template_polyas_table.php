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
        Schema::create('board_template_polyas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('board_template_id')->constrained()->cascadeOnDelete();

            $table->string('name');               // название
            $table->text('description')->nullable();
            $table->string('pole');               // поле
            $table->unsignedTinyInteger('sort')->default(50);  // сортировка, 2 знака, max 255
            $table->boolean('is_enabled')->default(true);
            $table->boolean('show_on_start')->default(false);
            $table->boolean('in_telega_msg')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_template_polyas');
    }
};
