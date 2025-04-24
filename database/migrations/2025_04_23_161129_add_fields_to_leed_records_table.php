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
        Schema::table('leed_records', function (Blueprint $table) {
            $table->string('platform')->nullable()->comment('Площадка');
            $table->string('link')->nullable()->comment('Ссылка');
            $table->unsignedInteger('base_number')->nullable()->comment('Номер в базе');
            $table->string('customer')->nullable()->comment('Заказчик');
            $table->date('payment_due_date')->nullable()->comment('Срок оплаты');
            $table->dateTime('submit_before')->nullable()->comment('Подать до');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_records', function (Blueprint $table) {
            $table->dropColumn([
                'platform',
                'link',
                'base_number',
                'customer',
                'payment_due_date',
                'submit_before'
            ]);
        });
    }
};
