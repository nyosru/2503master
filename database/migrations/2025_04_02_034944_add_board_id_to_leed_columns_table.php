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

            Schema::table('leed_columns', function (Blueprint $table) {

//            $table->unsignedBigInteger('board_id');

            // Внешние ключи
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
                ->onDelete('cascade')
            ;

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('leed_columns', function (Blueprint $table) {
            $table->dropColumn('board_id');
        });
    }
};
