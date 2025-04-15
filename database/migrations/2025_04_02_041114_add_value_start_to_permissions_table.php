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
//        'тех.Управление столбцами' => 82,
//        'р.Техничка' => 80,
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
