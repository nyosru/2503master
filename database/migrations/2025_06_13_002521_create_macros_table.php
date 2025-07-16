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
        Schema::create('macros', function (Blueprint $table) {
            $table->id();
            // Внешние ключи, nullable
            $table->foreignId('column_id')->nullable()->constrained('leed_columns')->nullOnDelete();
            $table->foreignId('leed_id')->nullable()->constrained('leed_records')->nullOnDelete();

            $table->string('name')->nullable();
            $table->string('comment')->nullable();

            // Прочие поля, nullable
            $table->string('type')->nullable();
            $table->string('to_telegrams')->comment('на какие телеги отправлять сообщение')->nullable();
            $table->string('message')->nullable();
            $table->integer('day')->nullable();

            $table->timestamps();
            $table->softDeletes(); // если нужна мягкая архивация
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('macros');
    }
};
