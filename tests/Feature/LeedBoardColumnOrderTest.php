<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Board;
use App\Models\LeedColumn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class LeedBoardColumnOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $board;
    protected $columns;

    protected function setUp(): void
    {
        parent::setUp();

        // Создаем пользователя
        $this->user = User::factory()->create();

        // Создаем доску
        $this->board = Board::factory()->create();

        // Создаем колонки для теста (без user_id)
        $this->columns = LeedColumn::factory()->count(5)->create([
            'board_id' => $this->board->id,
            'can_move' => true,
        ]);

        // Устанавливаем порядок колонок
        foreach ($this->columns as $index => $column) {
            $column->update(['order' => ($index + 1) * 10]);
        }
    }

//    #[Test]
//    public function it_can_update_column_order()
//    {
//        // Аутентифицируем пользователя
//        $this->actingAs($this->user);
//
//        // Получаем колонки до перемещения
//        $draggedColumn = $this->columns[0]; // Первая колонка
//        $targetColumn = $this->columns[2];  // Третья колонка
//
//        $initialOrder = $draggedColumn->order;
//        $targetOrder = $targetColumn->order;
//
//        // Вызываем метод updateColumnOrder
//        $component = new \App\Livewire\Cms2\Leed\LeedBoard($this->board->id);
//        $component->mount($this->board->id);
//        $component->updateColumnOrder($draggedColumn->id, $targetColumn->id);
//
//        // Обновляем модель из базы
//        $draggedColumn->refresh();
//
//        // Проверяем, что порядок изменился
//        $this->assertNotEquals($initialOrder, $draggedColumn->order);
//        $this->assertGreaterThan($targetOrder, $draggedColumn->order);
//
//        // Проверяем, что колонки переупорядочены
//        $columnsAfter = LeedColumn::where('board_id', $this->board->id)
//            ->orderBy('order')
//            ->get();
//
//        // Убеждаемся, что порядок уникален
//        $orders = $columnsAfter->pluck('order')->toArray();
//        $this->assertCount(count(array_unique($orders)), $orders, 'Все порядковые номера должны быть уникальными');
//    }

    #[Test]
    public function it_cannot_move_column_when_can_move_is_false()
    {
        $this->actingAs($this->user);

        // Создаем колонку, которую нельзя перемещать
        $lockedColumn = LeedColumn::factory()->create([
            'board_id' => $this->board->id,
            'can_move' => false,
            'order' => 100
        ]);

        $targetColumn = $this->columns[1];

        $initialOrder = $lockedColumn->order;

        // Пытаемся переместить заблокированную колонку
        $component = new \App\Livewire\Cms2\Leed\LeedBoard($this->board->id);
        $component->mount($this->board->id);
        $component->updateColumnOrder($lockedColumn->id, $targetColumn->id);

        // Обновляем модель
        $lockedColumn->refresh();

        // Проверяем, что порядок не изменился
        $this->assertEquals($initialOrder, $lockedColumn->order);
    }

    #[Test]
    public function it_reorders_columns_after_moving()
    {
        $this->actingAs($this->user);

        $draggedColumn = $this->columns[0];
        $targetColumn = $this->columns[3];

        $component = new \App\Livewire\Cms2\Leed\LeedBoard($this->board->id);
        $component->mount($this->board->id);
        $component->updateColumnOrder($draggedColumn->id, $targetColumn->id);

        // Получаем колонки после перемещения
        $columnsAfter = LeedColumn::where('board_id', $this->board->id)
            ->orderBy('order')
            ->get();

        // Проверяем, что порядок корректный
        for ($i = 1; $i < count($columnsAfter); $i++) {
            $this->assertGreaterThan(
                $columnsAfter[$i - 1]->order,
                $columnsAfter[$i]->order,
                'Порядок колонок должен быть последовательным'
            );
        }
    }

    #[Test]
    public function it_handles_nonexistent_columns_gracefully()
    {
        $this->actingAs($this->user);

        $component = new \App\Livewire\Cms2\Leed\LeedBoard($this->board->id);
        $component->mount($this->board->id);

        // Пытаемся переместить несуществующие колонки
        $component->updateColumnOrder(999, 1000);

        // Проверяем, что не возникло исключений
        $columns = LeedColumn::where('board_id', $this->board->id)
            ->orderBy('order')
            ->get();

        // Порядок не должен измениться
        $this->assertCount(5, $columns);
    }

    #[Test]
    public function it_maintains_unique_order_values()
    {
        $this->actingAs($this->user);

        // Создаем колонки с одинаковым порядком
        $column1 = LeedColumn::factory()->create([
            'board_id' => $this->board->id,
            'order' => 50,
            'can_move' => true
        ]);

        $column2 = LeedColumn::factory()->create([
            'board_id' => $this->board->id,
            'order' => 50, // Дублирующий порядок
            'can_move' => true
        ]);

        // Перемещаем колонку
        $component = new \App\Livewire\Cms2\Leed\LeedBoard($this->board->id);
        $component->mount($this->board->id);
        $component->updateColumnOrder($column1->id, $this->columns[0]->id);

        // Проверяем, что порядки уникальны
        $orders = LeedColumn::where('board_id', $this->board->id)
            ->pluck('order')
            ->toArray();

        $uniqueOrders = array_unique($orders);
        $this->assertCount(count($orders), $uniqueOrders, 'Все порядковые номера должны быть уникальными');
    }
}
