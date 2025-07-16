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
        Schema::create('macro_column', function (Blueprint $table) {
            $table->id();
            $table->foreignId('macro_id')->constrained('macros')->cascadeOnDelete();
            $table->foreignId('column_id')->constrained('leed_columns')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['macro_id', 'column_id']); // Уникальные комбинации
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('macro_column');
    }
};
