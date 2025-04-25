<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leed_records', function (Blueprint $table) {
            $table->string('cooperativ')->nullable()->comment('Кооператив');
//            $table->unsignedInteger('base_number')->nullable()->comment('Номер'); //, 'name' => 'Номер'];
            $table->string('fio2')->nullable()->comment('ФИО2'); // , 'name' => 'ФИО2'];
            $table->string('phone2')->nullable()->comment('Телефон2'); // , 'name' => 'Телефон2'];
            $table->date('date_start')->nullable()->comment('Дата старта'); // , 'name' => 'Дата старта'];
            $table->unsignedInteger('price')->nullable()->comment('Цена'); // , 'name' => 'Цена'];
            $table->date('pay_day_every_year')->nullable()->comment('Оплата ежегодно'); // , 'name' => 'Оплата ежегодно'];
            $table->smallInteger('pay_day_every_month')->nullable()->comment('Оплата ежемесячно'); // , 'name' => 'Оплата ежемесячно'];
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_records', function (Blueprint $table) {
            $table->dropColumn([
                'cooperativ',
//                'base_number',
                'fio2',
                'phone2',
                'date_start',
                'price',
                'pay_day_every_year',
                'pay_day_every_month',]);
        });
    }
};
