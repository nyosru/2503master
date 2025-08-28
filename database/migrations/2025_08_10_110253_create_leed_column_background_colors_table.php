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
        Schema::create('leed_column_background_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('html_code', 7)->nullable(); // например '#FF0000'
            $table->string('tailwind_classes')->nullable()->comment('Классы Tailwind CSS');
            $table->string('style_string')->nullable()->comment('Строка стилей CSS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_column_background_colors');
    }
};
