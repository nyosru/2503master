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

//            $table->string('cooperativ')->nullable()->comment('Кооператив');
////            $table->unsignedInteger('base_number')->nullable()->comment('Номер'); //, 'name' => 'Номер'];
//            $table->string('fio2')->nullable()->comment('ФИО2'); // , 'name' => 'ФИО2'];
//            $table->string('phone2')->nullable()->comment('Телефон2'); // , 'name' => 'Телефон2'];
//            $table->date('date_start')->nullable()->comment('Дата старта'); // , 'name' => 'Дата старта'];
//            $table->unsignedInteger('price')->nullable()->comment('Цена'); // , 'name' => 'Цена'];
//            $table->date('pay_day_every_year')->nullable()->comment('Оплата ежегодно'); // , 'name' => 'Оплата ежегодно'];
//            $table->smallInteger('pay_day_every_month')->nullable()->comment('Оплата ежемесячно'); // , 'name' => 'Оплата ежемесячно'];

//            1. телефон заказчика и его ФИО
//2. эл.почта заказчика
            $table->string('email')->nullable()->comment('Почта заказчика');
//3. название переделать в предмет тендера
            $table->string('obj_tender')->nullable()->comment('предмет тендера');
//4. Заказчик
            $table->string('zakazchick')->nullable()->comment('Заказчик');
//5.  срок поставки от и до (45-60 дней)
            $table->unsignedInteger('post_day_ot')->nullable()->comment('срок поставки от'); // , 'name' => 'Цена'];
            $table->unsignedInteger('post_day_do')->nullable()->comment('срок поставки до'); // , 'name' => 'Цена'];
//6. место поставки
            $table->string('mesto_dostavki')->nullable()->comment('место поставки');
// 7. номер в базе
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leed_records', function (Blueprint $table) {
            $table->dropColumn([
//                'cooperativ',
////                'base_number',
//                'fio2',
//                'phone2',
//                'date_start',
//                'price',
//                'pay_day_every_year',
//                'pay_day_every_month',


//            1. телефон заказчика и его ФИО
//2. эл.почта заказчика
                'email',
                'obj_tender',
                'zakazchick',
                'post_day_ot',
                'post_day_do',
                'mesto_dostavki',
            ]);
        });
    }
};
