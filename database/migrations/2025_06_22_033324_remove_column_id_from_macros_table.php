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
        Schema::table('macros', function (Blueprint $table) {
            $table->dropForeign(['column_id']); // Удаляем внешний ключ
            $table->dropColumn('column_id');    // Удаляем столбец
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('macros', function (Blueprint $table) {
            $table->foreignId('column_id')->nullable()->constrained('leed_columns')->nullOnDelete();
        });
    }
};
