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
        Schema::create('leed_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('content', 255)->nullable();
            $table->unsignedBigInteger('leed_column_id');
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->text('comment')->nullable();
            $table->boolean('show')->default(true);
            $table->string('otkaz_reason', 500)->nullable()->comment('Если лид ушёл в отказники, то указываем причину почему такое решение');
            $table->unsignedBigInteger('client_supplier_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedInteger('budget')->nullable();
            $table->unsignedInteger('order_product_types_id')->nullable();
            $table->string('fio', 255)->nullable();

            // Foreign keys
            $table->foreign('leed_column_id')->references('id')->on('leed_columns')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_records');
    }
};
