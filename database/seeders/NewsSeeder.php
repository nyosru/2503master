<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем несколько тестовых новостей
        $users = User::limit(5)->get();

        if ($users->isEmpty()) {
            $users = User::factory(3)->create();
        }

        News::factory(20)->create([
            'author_user_id' => fn() => $users->random()->id,
        ]);

        // Создаем несколько опубликованных новостей
        News::factory(10)->published()->create([
            'author_user_id' => fn() => $users->random()->id,
        ]);
    }
}
