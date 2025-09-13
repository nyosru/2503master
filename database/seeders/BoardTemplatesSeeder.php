<?php

namespace Database\Seeders;

use App\Models\BoardColumnTemplate;
use App\Models\BoardPositionTemplate;
use App\Models\BoardTemplate;
use App\Models\BoardTemplatePolya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицы
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        BoardTemplatePolya::truncate();
        BoardColumnTemplate::truncate();
        BoardPositionTemplate::truncate();
        BoardTemplate::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Создаем шаблоны досок
        $templates = [
            [
                'id' => 1,
                'name' => 'СТО мастер',
                'status' => 1,
                'price' => 0,
                'sort' => 50,
                'start_template' => 1,
                'created_at' => '2025-08-18 10:42:55',
                'updated_at' => '2025-08-18 10:42:55'
            ],
            [
                'id' => 2,
                'name' => 'Производство ремонта',
                'status' => 1,
                'price' => 0,
                'sort' => 50,
                'start_template' => 0,
                'created_at' => '2025-08-18 13:49:33',
                'updated_at' => '2025-08-18 13:49:33'
            ]
        ];

        foreach ($templates as $template) {
            BoardTemplate::create($template);
        }

        // Колонки для шаблона 1
        $columnsTemplate1 = [
            ['id' => 4, 'board_template_id' => 1, 'name' => 'Первый контакт', 'sorting' => 10, 'created_at' => '2025-08-18 11:51:11'],
            ['id' => 5, 'board_template_id' => 1, 'name' => 'Подготовка договора, подписание', 'sorting' => 20, 'created_at' => '2025-08-18 11:51:37'],
            ['id' => 6, 'board_template_id' => 1, 'name' => 'Ремонт', 'sorting' => 30, 'created_at' => '2025-08-18 11:51:52'],
            ['id' => 7, 'board_template_id' => 1, 'name' => 'Подписать акт выполненных работ, отдать машину', 'sorting' => 40, 'created_at' => '2025-08-18 11:52:34'],
            ['id' => 8, 'board_template_id' => 1, 'name' => 'уточнить как авто (через 3 недели)', 'sorting' => 60, 'created_at' => '2025-08-18 11:53:00'],
            ['id' => 9, 'board_template_id' => 1, 'name' => 'Авто отдали, договор закрыт', 'sorting' => 40, 'created_at' => '2025-08-18 11:54:01'],
            ['id' => 10, 'board_template_id' => 1, 'name' => 'не дошли до предложения договора', 'sorting' => 15, 'created_at' => '2025-08-18 11:54:35'],
            ['id' => 11, 'board_template_id' => 1, 'name' => 'не подписали наше предложение', 'sorting' => 25, 'created_at' => '2025-08-18 11:54:52']
        ];

        foreach ($columnsTemplate1 as $column) {
            BoardColumnTemplate::create($column);
        }

        // Колонки для шаблона 2
        $columnsTemplate2 = [
            ['id' => 12, 'board_template_id' => 2, 'name' => 'Первый контакт', 'sorting' => 20, 'created_at' => '2025-08-18 13:49:48'],
            ['id' => 13, 'board_template_id' => 2, 'name' => 'Высянить потребности, подписать договор', 'sorting' => 30, 'created_at' => '2025-08-18 13:50:16'],
            ['id' => 14, 'board_template_id' => 2, 'name' => 'Сделать ремонт', 'sorting' => 40, 'created_at' => '2025-08-18 13:50:25'],
            ['id' => 15, 'board_template_id' => 2, 'name' => 'Подписать акт выполненных работ, отдать', 'sorting' => 50, 'created_at' => '2025-08-18 13:50:42']
        ];

        foreach ($columnsTemplate2 as $column) {
            BoardColumnTemplate::create($column);
        }

        // Позиции для шаблона 1
        $positionsTemplate1 = [
            ['id' => 4, 'board_template_id' => 1, 'name' => 'Приёмщик', 'sorting' => 50, 'created_at' => '2025-08-18 11:55:09'],
            ['id' => 5, 'board_template_id' => 1, 'name' => 'Механик', 'sorting' => 50, 'created_at' => '2025-08-18 11:55:29'],
            ['id' => 6, 'board_template_id' => 1, 'name' => 'Кассир', 'sorting' => 50, 'created_at' => '2025-08-18 11:55:48']
        ];

        foreach ($positionsTemplate1 as $position) {
            BoardPositionTemplate::create($position);
        }

        // Позиции для шаблона 2
        $positionsTemplate2 = [
            ['id' => 7, 'board_template_id' => 2, 'name' => 'Менеджер', 'sorting' => 50, 'created_at' => '2025-08-18 13:51:08'],
            ['id' => 8, 'board_template_id' => 2, 'name' => 'Техник', 'sorting' => 50, 'created_at' => '2025-08-18 13:51:14']
        ];

        foreach ($positionsTemplate2 as $position) {
            BoardPositionTemplate::create($position);
        }

        // Поля для шаблона 1
        $polyasTemplate1 = [
            ['id' => 2, 'board_template_id' => 1, 'name' => 'цена', 'pole' => 'number1', 'sort' => 40, 'is_enabled' => 1, 'show_on_start' => 0, 'in_telega_msg' => 0, 'created_at' => '2025-08-18 10:43:36'],
            ['id' => 4, 'board_template_id' => 1, 'name' => 'С чем обратились', 'pole' => 'string2', 'sort' => 70, 'is_enabled' => 1, 'show_on_start' => 1, 'in_telega_msg' => 0, 'created_at' => '2025-08-18 11:56:50'],
            ['id' => 5, 'board_template_id' => 1, 'name' => 'Авто', 'description' => 'марка модель цвет', 'pole' => 'string1', 'sort' => 80, 'is_enabled' => 1, 'show_on_start' => 1, 'in_telega_msg' => 1, 'created_at' => '2025-08-18 11:57:13'],
            ['id' => 6, 'board_template_id' => 1, 'name' => 'Клиент', 'pole' => 'fio', 'sort' => 60, 'is_enabled' => 1, 'show_on_start' => 1, 'in_telega_msg' => 0, 'created_at' => '2025-08-18 11:57:28'],
            ['id' => 7, 'board_template_id' => 1, 'name' => 'Телефон', 'pole' => 'phone', 'sort' => 55, 'is_enabled' => 1, 'show_on_start' => 0, 'in_telega_msg' => 0, 'created_at' => '2025-08-18 11:57:48']
        ];

        foreach ($polyasTemplate1 as $polya) {
            BoardTemplatePolya::create($polya);
        }

        // Поля для шаблона 2
        $polyasTemplate2 = [
            ['id' => 8, 'board_template_id' => 2, 'name' => 'Обьект', 'description' => 'что ремонтируем', 'pole' => 'string1', 'sort' => 80, 'is_enabled' => 1, 'show_on_start' => 1, 'in_telega_msg' => 1, 'created_at' => '2025-08-18 13:51:42'],
            ['id' => 9, 'board_template_id' => 2, 'name' => 'клиент', 'pole' => 'fio', 'sort' => 40, 'is_enabled' => 1, 'show_on_start' => 1, 'in_telega_msg' => 1, 'created_at' => '2025-08-18 13:52:06'],
            ['id' => 10, 'board_template_id' => 2, 'name' => 'Телефон', 'pole' => 'phone', 'sort' => 35, 'is_enabled' => 1, 'show_on_start' => 0, 'in_telega_msg' => 0, 'created_at' => '2025-08-18 13:52:18']
        ];

        foreach ($polyasTemplate2 as $polya) {
            BoardTemplatePolya::create($polya);
        }

        $this->command->info('Board templates seeded successfully!');
    }
}
