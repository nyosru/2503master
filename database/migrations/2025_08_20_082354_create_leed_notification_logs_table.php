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
        Schema::create('leed_notification_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('leed_notification_id')->constrained()->cascadeOnDelete();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->boolean('result_ok')->default(false);    // Результат или описание, например, статус отправки
            $table->boolean('result_error')->default(false);    // Результат или описание, например, статус отправки

            $table->string('result')->nullable();    // Результат или описание, например, статус отправки
            $table->string('error')->nullable();     // Ошибки, если были

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_notification_logs');
    }
};
