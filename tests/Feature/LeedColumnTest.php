<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\LeedColumn;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LeedColumnTest extends TestCase
{


//    /**
//     * A basic feature test example.
//     */
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    use RefreshDatabase;


//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Пропускаем создание полнотекстовых индексов в тестах
//        if (config('database.default') === 'sqlite') {
//            Schema::disableFulltextIndex();
//        }
//    }


    #[Test]
    public function it_can_create_leed_column()
    {
        // Подготовка
        $user = User::factory()->create();
        $board = Board::factory()->create();

        // Действие
        $column = LeedColumn::create([
            'name' => 'Test Column',
//            'user_id' => $user->id,
            'board_id' => $board->id,
            'order' => 1,
            'can_move' => true,
        ]);

        // Проверка
        $this->assertDatabaseHas('leed_columns', [
            'name' => 'Test Column',
            'board_id' => $board->id,
        ]);

        $this->assertEquals('Test Column', $column->name);
    }

    #[Test]
    public function it_can_move_column_to_position()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create();

        $column1 = LeedColumn::create(['name' => 'Col1', 'board_id' => $board->id,
//            'user_id' => $user->id,
            'order' => 1]);
        $column2 = LeedColumn::create(['name' => 'Col2', 'board_id' => $board->id,
//            'user_id' => $user->id,
            'order' => 2]);

        $column2->moveToPosition(1);

        $this->assertEquals(1, $column2->fresh()->order);
        $this->assertEquals(2, $column1->fresh()->order);
    }

}
