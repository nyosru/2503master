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
        Schema::create('logs2s', function (Blueprint $table) {
            $table->id();

            $table->text('comment');
            $table->timestamp('reminder_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('order_id')->nullable();
            $table->json('data')->nullable(); // JSON-поле с проверкой на валидность
            $table->unsignedBigInteger('leed_record_id');
            $table->string('type', 255)->nullable();

            // Внешние ключи (опционально)
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
//                ->onDelete('cascade')
            ;

//            $table->foreign('order_id')
//                ->references('id')
//                ->on('orders')
////                ->onDelete('set null')
//            ;

            $table->foreign('leed_record_id')
                ->references('id')
                ->on('leed_records')
//                ->onDelete('cascade')
            ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs2s');
    }
};
