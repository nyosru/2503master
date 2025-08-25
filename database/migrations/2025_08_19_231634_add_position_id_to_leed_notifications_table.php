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
        Schema::table('leed_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable()
                ->comment('Рассылать оповещение всем кто в определённой должности')
                ->after('user_id');

            // Если хотите добавить внешний ключ:
            $table->foreign('position_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_notifications', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropColumn('position_id');
        });
    }
};
