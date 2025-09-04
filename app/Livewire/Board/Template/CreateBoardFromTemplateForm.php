<?php

namespace App\Livewire\Board\Template;

use App\Http\Controllers\BoardController;
use App\Http\Controllers\Master\PositionController;
use App\Models\BoardFieldSetting;
use App\Livewire\Cms2\Leed\LeedBoard;
use App\Models\Board;
use App\Models\BoardTemplate;
use App\Models\BoardUser;
use App\Models\ColumnRole;
use App\Models\OrderRequest;
use App\Models\OrderRequestsRename;
use App\Models\PermissionSetting;
use Livewire\Component;
use phpseclib3\Math\PrimeField\Integer;

class CreateBoardFromTemplateForm extends Component
{

    public $template_id;
    public $board_name;



    /**
     * создание должностей в доске
     * @param $template
     * @param $newBoard
     * @return int
     */
//    public function createPositionInBoardFromShablon($template, $newBoard): int



    public function createBoardFromShablon($template_id)
    {

        $bc = new BoardController;
//        $res[$newBoard_id, $new_position_id] = $bc->createBoardFromTemplate($template_id);
        [$newBoard_id, $new_position_id] = $bc->createBoardFromTemplate($template_id);
        dd([$newBoard_id, $new_position_id]);

        if(1==2){
        $template = BoardTemplate::where('id', $template_id)
            ->with([
                'columns' => function ($query) {
                    $query->orderBy('sorting', 'asc');
                },
                'positions',
                'polya'
            ])
            ->first();

        // создание новой доски
        $newBoard = Board::create([
            'name' => $this->board_name,
            'admin_user_id' => auth()->user()->id
        ]);

        // создание полей в новую доску из шаблона
//        $this->setConfigNewBoard($newBoard, $template->polya->toArray());
        $b = new BoardController;
        $b->setConfigNewBoard($newBoard, $template->polya->toArray());

        // создание должностей в новую доску из шаблона
        $new_position_id = $this->createPositionInBoardFromShablon($template, $newBoard);

        BoardUser::create([
            'board_id' => $newBoard->id,
            'user_id' => auth()->user()->id,
            'role_id' => $new_position_id,
        ]);


        $sort = 1;
        $start = true;

        foreach ($template->columns as $column) {
//            dump($column);

            $datain_col = [
                'name' => $column->name,
                'order' => $sort,
            ];

            if ($start) {
                $datain_col['can_create'] = true;
                $start = false;
            }

            $columnNew = $newBoard->columns()->create($datain_col);

            ColumnRole::create([
                'column_id' => $columnNew->id,
                'role_id' => $new_position_id,
            ]);

            $sort += 2;
        }
    }

        BoardController::enterAs($newBoard->id, $new_position_id);
        session()->flash('createBoardGoodFromTemplate', 'Доска создана, настраивайте шаги, проведите тест драйв!');

        return redirect()->route('leed', [
            'board_id' => $newBoard->id
        ]);


    }

    public function render()
    {
        return view('livewire.board.template.create-board-from-template-form');
    }

}
