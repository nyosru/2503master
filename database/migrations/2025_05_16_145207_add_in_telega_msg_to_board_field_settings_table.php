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
            $table->boolean('in_telega_msg')
                ->comment('Выводить поле в сообщении телеграмм')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_field_settings', function (Blueprint $table) {
            $table->dropColumn('in_telega_msg');
        });
    }
};
