<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public $in = [

//         	phone
        ['name' => 'Название', 'pole' => 'name', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'ФИО', 'pole' => 'fio', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],

        ['name' => 'Телефон', 'pole' => 'phone', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Телеграм', 'pole' => 'telegram', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'WatsApp', 'pole' => 'whatsapp', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Компания', 'pole' => 'company', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Комментарий', 'pole' => 'comment', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],

        ['name' => 'ФИО2', 'pole' => 'fio2', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Телефон2', 'pole' => 'phone2', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Почта заказчика', 'pole' => 'email', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],

        ['name' => 'Площадка', 'pole' => 'platform', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['name' => 'Ссылка', 'pole' => 'link', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],

        ['pole' => 'customer', 'name' => 'Заказчик', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['pole' => 'cooperativ', 'name' => 'Кооператив', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['pole' => 'obj_tender', 'name' => 'предмет тендера', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['pole' => 'zakazchick', 'name' => 'Заказчик', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
        ['pole' => 'mesto_dostavki', 'name' => 'место поставки', 'string' => 1, 'nullable' => 1, 'rules' => 'nullable|string',],
//            int(10) 		UNSIGNED
        ['pole' => 'base_number', 'name' => 'Номер в базе', 'number' => 1, 'nullable' => 1, 'rules' => 'nullable|integer',],
//	 	date 			Да 	NULL
        ['pole' => 'payment_due_date', 'name' => 'Срок оплаты 		Изменить Изменить 	Удалить Удалить'],
//    	datetime
        ['pole' => 'submit_before', 'name' => 'Подать до', 'is_datetime' => 1, 'rules' => 'nullable|datetime'],

        ['pole' => 'date_start', 'name' => 'Дата старта', 'is_datetime' => 1, 'rules' => 'nullable|date'],

// int(10)
        ['pole' => 'price', 'name' => 'Цена', 'number' => 1, 'nullable' => 1, 'rules' => 'nullable|integer',],
//	 		date
        ['pole' => 'pay_day_every_year', 'name' => 'Оплата ежегодно', 'is_datetime' => 1, 'rules' => 'nullable|date'],
//    smallint(6)
        ['pole' => 'pay_day_every_month', 'name' => 'Оплата ежемесячно', 'number' => 1, 'nullable' => 1, 'rules' => 'nullable|integer',],
//	 	int(10)
        ['pole' => 'post_day_ot', 'name' => 'срок поставки от', 'number' => 1, 'nullable' => 1, 'rules' => 'nullable|integer',],
//    	int(10)
        ['pole' => 'post_day_do', 'name' => 'срок поставки до', 'number' => 1, 'nullable' => 1, 'rules' => 'nullable|integer',],

    ];


    /**
     * Run the migrations.
     */
    public function up(): void
    {

        foreach ($this->in as $ii) {
            $ii['created_at'] = '2025-05-05 03:12:16';
            $ii['updated_at'] = '2025-05-13 03:12:16';
            DB::table('order_requests')->insert($ii);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        $w = [];
        foreach ($this->in as $ii) {
            $w[] = $ii['pole'];
        }

        // Можно удалить записи по полю pole, например:
        DB::table('order_requests')->whereIn('pole', $w)->delete();

    }
};
