<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public $a = [
//        'р.Заказы' => 40,
//        'р.Клиенты' => 45,
//        'р.Лиды / добавить лида' => 32,
//        'р.Лиды / отправить лида с дог-ом' => 32,
//        'Полный//доступ' => 95,
//        'р.Пользователи / Изменять роли' => 52,
//        'р.Пользователи / восстановить' => 52,
//        'р.Пользователи / удалить' => 52,
//        'р.Лиды / двигать столбцы' => 32,
//        'р.Лиды / конфиг столбцов' => 32,
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
        'тех.упр - путь заказа / видеть все доски' => 82,
//        'р.Доски / видеть все доски' => 36,
//        'р.Доски / создавать приглашения' => 36,
//        'р.Доски / переименовывать поля лидов' => 36,
//        '' => 30,
//        '' => 30,
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach( $this->a as $k => $v ) {
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
        foreach( $this->a as $k => $v ) {
            DB::table('permissions')->where('name', $k )->delete();
        }
    }
};
