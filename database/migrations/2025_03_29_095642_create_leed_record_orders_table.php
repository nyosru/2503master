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
        Schema::create('leed_record_orders', function (Blueprint $table) {
            $table->id();

            $table->text('text');
            $table->timestamp('reminder_at')->nullable();
            $table->enum('status', ['новая', 'готово', 'отменена'])->default('новая');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('leed_record_id')->nullable();
            $table->text('close_comment')->nullable();
            $table->timestamp('close_at')->nullable();
            $table->unsignedBigInteger('user_worker_id')->nullable();
            $table->string('worker_comment', 255)->nullable();
            $table->boolean('worker_job_status')->nullable();
            $table->timestamp('worker_comment_at')->nullable();

            // Внешние ключи (опционально)
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('leed_record_id')
                ->references('id')
                ->on('leed_records')
                ->onDelete('set null');

            $table->foreign('user_worker_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->softDeletes(); // Добавляет столбец `deleted_at`
            $table->timestamps(); // Добавляет столбцы `created_at` и `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_record_orders');
    }
};
