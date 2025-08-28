<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration {

    public $a = [
//        'р.Заказы' => 40,
//        'р.Клиенты' => 45,
//        'р.Лиды / добавить лида' => 32,
//        'р.Лиды / отправить лида с дог-ом' => 32,
//        'р.Лиды / добавить столбцы' => 32,
//        'Полный//доступ' => 95,
//        'р.Пользователи / Изменять роли' => 52,
//        'р.Пользователи / восстановить' => 52,
//        'р.Пользователи / удалить' => 52,
//        'р.Лиды / двигать столбцы' => 32,
//        'р.Лиды / конфиг столбцов' => 32,
//        'р.Лиды / создать первый столбец' => 32,
//        'р.Лиды / доска конфиг' => 34,
//        'р.Доски' => 35,
//        'р.Доски / удалить' => 36,
//        'р.Доски / восстановить' => 36,
//        'р.Доски / видеть удалённые' => 36,
//                'р.Деньги' => 42,
//                'р.Деньги / добавлять записи' => 43,
//                'р.Деньги / видеть удалённые записи' => 43,
//                'р.Деньги / видеть записи' => 43,
//                'р.Деньги / удалять записи' => 43,
//        'р.Техничка' => 80,
//        'тех.упр полями в лиде' => 81,
        //'р.Техничка / шаблоны (упр)' => 81,
//        'р.Техничка / установка старт доступов (адм)' => 81,
//        'р.Техничка / поиск по ИНН' => 81,
//        'р.Техничка / Домены' => 81,
//        'р.Техничка / Доска Макросы' => 81,
//        'тех.ТипПродуктаУпр' не найдено
        'тех.ТипОплатыМен' => 81,
        'р.Права доступа' => 55,
        'р.Пользователи' => 50,

//        'тех.упр - путь заказа / видеть все доски' => 82,
//        'р.Доски / видеть все доски' => 36,
//        'р.Доски / создавать приглашения' => 36,
//        'р.Доски / переименовывать поля лидов' => 36,
//        '' => 30,
//        '' => 30,
    ];

    /**
     * Run the migrations.
     */
    public function sync()
    {

        info('=== Начало синхронизации разрешений ===');


        $links = ['Домены' => ['route' => 'tech.domain.create',
            'permission' => 'р.Техничка / Домены'],
            'Заказ: Типы заказа' => ['route' => 'tech.order.product-type-manager', 'permission' => 'тех.ТипПродуктаУпр'],
            'Заказ: Типы оплаты' => ['route' => 'tech.order.payment-type-manager', 'permission' => 'тех.ТипОплатыМен'],
            'Права доступа должностям' => ['route' => 'tech.role_permission', 'permission' => 'р.Права доступа'],
//        'Источники лида' => ['route' => 'tech.ClientSupplierManager', 'permission' => 'р.Поставщики лидов'],
            'Пользователи' => ['route' => 'tech.user_list', 'permission' => 'р.Пользователи'],
            'Путь заказа, доступы' => ['route' => 'tech.adm_role_column', 'permission' => 'тех.Управление столбцами'],
            'Поиск данных по inn' => ['route' => 'tech.service.dadata_org_search_component'
                , 'permission' => 'р.Техничка / поиск по ИНН'],
            'Поля в заказе' => ['route' => 'tech.order_requests_manager', 'permission' => 'тех.упр полями в лиде'],


            'Доска / Лид / Названия полей - Переименовать' => ['route' => 'tech.order-request-rename-form'
                , 'permission' => 'р.Доски / переименовывать поля лидов'],
            'Доска / Автоматизация' => ['route' => 'service.automation_rules_manager'
//            , 'permission' => 'р.Доски / переименовывать поля лидов'
            ]
            ,
            'Доска / Макросы' => ['route' => 'tech.macros.manager'
                , 'permission' => 'р.Техничка / Доска Макросы']
            ,
            'Доска / Шаблоны' => ['route' => 'tech.board.template.manager'
                , 'permission' => 'р.Техничка / шаблоны (упр)']];

        foreach ($links as $k => $v) {
            try {
                $exists = DB::table('permissions')->where('name', $v['permission'])->exists();

                if ($exists) {
                    info("✓ Разрешение '{$v['permission']}' существует");
                } else {
                    info("✗ Разрешение '{$v['permission']}' не найдено");
                }
            } catch (\Exception $e) {
                info("Ошибка при проверке " . $e->getMessage());
            }

        }

    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        $this->sync();
        foreach ($this->a as $k => $v) {
            DB::table('permissions')->insert([
                'name' => $k,
                'guard_name' => 'web',
                'sort' => $v,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Log::info('221122');

        foreach ($this->a as $k => $v) {
            DB::table('permissions')->where('name', $k)->delete();
        }
    }
};
