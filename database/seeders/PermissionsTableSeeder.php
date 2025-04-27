<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('permissions')->truncate();

        $permissions = [
//            INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `sort`) VALUES
            ['name' => 'р.Права доступа', 'guard_name' => 'web', 'sort' => 70 ],
            ['name' => 'р.Пользователи', 'guard_name' => 'web', 'sort' =>  50 ],
            ['name' => 'разработка', 'guard_name' => 'web', 'sort' => 90 ],
            ['name' => 'р.Права доступа / изменить роли', 'guard_name' => 'web', 'sort' =>  72 ],
            ['name' => 'р.Лиды', 'guard_name' => 'web', 'sort' => 30 ],
            ['name' => 'р.Лиды / добавить столбцы', 'guard_name' => 'web','sort' =>  32 ],
//            ['name' => 'р.Заказы', 'guard_name' => 'web', 'sort' => 40 ],
//            ['name' => 'р.Клиенты', 'guard_name' => 'web', 'sort' =>  45 ],
//            ['name' =>'р.Лиды / добавить лида', 'guard_name' => 'web', 'sort' =>  32 ],
//            ['name' =>'р.Лиды / отправить лида с дог-ом', 'guard_name' => 'web', 'sort' =>  32 ],
//            ['name' => 'Полный//доступ', 'guard_name' => 'web', 'sort' =>  95 ],
//            ['name' => 'р.Пользователи / Изменять роли', 'guard_name' => 'web', 'sort' =>  52 ],
//            ['name' => 'р.Пользователи / восстановить', 'guard_name' => 'web', 'sort' =>  52 ],
//            ['name' => 'р.Пользователи / удалить', 'guard_name' => 'web', 'sort' =>  52 ],
//            ['name' => 'тех.Управление столбцами', 'guard_name' => 'web', 'sort' =>  82 ],
//            ['name' => 'р.Техничка', 'guard_name' => 'web', 'sort' =>  80 ]
//            [
//                'id' => 16,
//                'name' => 'р.Техничка',
//                'guard_name' => 'web',
//                'sort' => 80,
//                'created_at' => '2025-03-30 14:56:48',
//                'updated_at' => '2025-03-30 14:56:48'
//            ]
        ];

        foreach( $permissions as $permission ){
            $permission['created_at'] = '2025-03-30 14:56:48';
            $permission['updated_at'] = '2025-03-30 14:56:48';
            DB::table('permissions')->insert($permission);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
