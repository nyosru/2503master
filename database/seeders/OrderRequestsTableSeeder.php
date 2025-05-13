<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Название',
                'pole' => 'name',
                'description' => 'Название',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Компания',
                'pole' => 'company',
                'description' => 'Компания',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Кооператив',
                'pole' => 'cooperativ',
                'description' => 'Кооператив',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Платформа',
                'pole' => 'platform',
                'description' => 'Платформа',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Ссылка',
                'pole' => 'link',
                'description' => 'Ссылка',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Номер',
                'pole' => 'base_number',
                'description' => 'Номер',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'ФИО',
                'pole' => 'fio',
                'description' => 'ФИО',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Телефон',
                'pole' => 'phone',
                'description' => 'Телефон',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:20',
            ],
            [
                'name' => 'ФИО2',
                'pole' => 'fio2',
                'description' => 'ФИО2',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Телефон2',
                'pole' => 'phone2',
                'description' => 'Телефон2',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Телеграм id',
                'pole' => 'telegram',
                'description' => 'Телеграм id',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'WatsApp id',
                'pole' => 'whatsapp',
                'description' => 'WatsApp id',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:255',
            ],
            [
                'name' => 'Дата старта',
                'pole' => 'date_start',
                'description' => 'Дата старта',
                'date' => true,
                'nullable' => true,
                'rules' => 'nullable|date',
            ],
            [
                'name' => 'Комментарий',
                'pole' => 'comment',
                'description' => 'Комментарий',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string|max:1000',
            ],
            [
                'name' => 'Бюджет',
                'pole' => 'budget',
                'description' => 'Бюджет',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'Цена',
                'pole' => 'price',
                'description' => 'Цена',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'Тип продукта',
                'pole' => 'order_product_types_id',
                'description' => 'Тип продукта',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|exists:order_product_types,id',
            ],
            [
                'name' => 'Пользователь',
                'pole' => 'customer',
                'description' => 'Пользователь',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Дата после оплаты',
                'pole' => 'payment_due_date',
                'description' => 'Дата после оплаты',
                'date' => true,
                'nullable' => true,
                'rules' => 'nullable|date',
            ],
            [
                'name' => 'Подать до',
                'pole' => 'submit_before',
                'description' => 'Подать до',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'Оплата ежегодно',
                'pole' => 'pay_day_every_year',
                'description' => 'Оплата ежегодно',
                'date' => true,
                'nullable' => true,
                'rules' => 'nullable|date',
            ],
            [
                'name' => 'Оплата ежемесячно',
                'pole' => 'pay_day_every_month',
                'description' => 'Оплата ежемесячно',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'E-mail заказчика',
                'pole' => 'email',
                'description' => 'E-mail заказчика',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Предмет тендера',
                'pole' => 'obj_tender',
                'description' => 'Предмет тендера',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Заказчик',
                'pole' => 'zakazchick',
                'description' => 'Заказчик',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
            [
                'name' => 'Срок поставки от',
                'pole' => 'post_day_ot',
                'description' => 'Срок поставки от',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'Срок поставки до',
                'pole' => 'post_day_do',
                'description' => 'Срок поставки до',
                'number' => true,
                'nullable' => true,
                'rules' => 'nullable|integer',
            ],
            [
                'name' => 'Место поставки',
                'pole' => 'mesto_dostavki',
                'description' => 'Место поставки',
                'string' => true,
                'nullable' => true,
                'rules' => 'nullable|string',
            ],
        ];

        foreach ($fields as $field) {
            DB::table('order_requests')->insert([
                'name' => $field['name'],
                'pole' => $field['pole'],
                'description' => $field['description'],
                'number' => $field['number'] ?? false,
                'date' => $field['date'] ?? false,
                'text' => $field['text'] ?? false,
                'string' => $field['string'] ?? false,
                'nullable' => $field['nullable'] ?? false,
                'rules' => $field['rules'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
