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
        Schema::create('leed_record_user_changes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('leed_record_id');
            $table->unsignedBigInteger('new_user_id');

            // Внешние ключи (опционально)
            $table->foreign('leed_record_id')
                ->references('id')
                ->on('leed_records')
                ->onDelete('cascade');

            $table->foreign('new_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_record_user_changes');
    }
};
