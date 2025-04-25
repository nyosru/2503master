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
        Schema::table('board_field_settings', function (Blueprint $table) {
            $table->unsignedTinyInteger('sort_order')->nullable()->default(0)->comment('Порядок сортировки');
            $table->string('name')->nullable()->comment('Название поля');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_field_settings', function (Blueprint $table) {
            $table->dropColumn('sort_order');
            $table->dropColumn('name');
        });
    }
};
