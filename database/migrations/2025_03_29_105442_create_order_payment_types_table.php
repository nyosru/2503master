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
        Schema::create('order_payment_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->string('var_to_one', 255)->nullable();
            $table->unsignedInteger('prepay')->nullable();

            $table->softDeletes(); // Добавляет столбец `deleted_at`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payment_types');
    }
};
