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
        Schema::table('logs2s', function (Blueprint $table) {
            $table->unsignedBigInteger('board_id')->nullable()->after('leed_record_id');
            $table->unsignedBigInteger('leed_record_id')->nullable()->change();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs2s', function (Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropColumn('board_id');

            $table->unsignedBigInteger('leed_record_id')->nullable(false)->change();
        });
    }
};
