<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        User::factory()->create([
            'name' => 'Сергей Поддержка',
            'email' => '1@php-cat.com',
            'password' => Hash::make('123123123'), // Не храните пароли в открытом виде
        ]);
        User::factory()->create([
            'name' => 'Тест Руководитель',
            'email' => 'test.ruk@php-cat.com',
            'password' => Hash::make('password'), // Не храните пароли в открытом виде
        ]);
        User::factory()->create([
            'name' => 'Тест Пользователь',
            'email' => 'test.user@php-cat.com',
            'password' => Hash::make('password'), // Не храните пароли в открытом виде
        ]);

        $this->call(BoardsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
