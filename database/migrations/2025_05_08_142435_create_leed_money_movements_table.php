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
        Schema::create('leed_money_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('leed_record_id')
                ->constrained('leed_records')
                ->cascadeOnDelete();

            $table->decimal('amount', 15, 2); // Сумма с 2 знаками (включая отрицательные)

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('operation_date')->nullable();
            $table->string('comment')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leed_money_movements');
    }
};
