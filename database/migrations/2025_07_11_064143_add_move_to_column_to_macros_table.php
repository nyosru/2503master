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
            // Добавляем nullable внешний ключ move_to_column на таблицу leed_columns
            $table->unsignedBigInteger('move_to_column')->nullable()->after('day');

            $table->foreign('move_to_column')
                ->references('id')
                ->on('leed_columns')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('macros', function (Blueprint $table) {
            Schema::table('macros', function (Blueprint $table) {
                // Удаляем внешний ключ и поле
                $table->dropForeign(['move_to_column']);
                $table->dropColumn('move_to_column');
            });
        });
    }
};
