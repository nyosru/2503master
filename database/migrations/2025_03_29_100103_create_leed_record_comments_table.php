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
        Schema::create('leed_record_comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('leed_record_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('addressed_to_user_id')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('readed')->default(false);
            $table->unsignedBigInteger('parent_id')->nullable();

            // Внешние ключи (опционально)
            $table->foreign('leed_record_id')
                ->references('id')
                ->on('leed_records')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('addressed_to_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('parent_id')
                ->references('id')
                ->on('leed_record_comments')
                ->onDelete('cascade');

            $table->softDeletes(); // Добавляет столбец `deleted_at`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_record_comments');
    }
};
