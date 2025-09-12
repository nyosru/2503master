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
        [$newBoard_id, $new_position_id] = $bc->createBoardFromTemplate($template_id, $this->board_name);

        BoardController::enterAs($newBoard_id, $new_position_id);
        session()->flash('createBoardGoodFromTemplate', 'Доска создана, настраивайте шаги, проведите тест драйв!');

        return redirect()->route('board.show', [
            'board_id' => $newBoard_id
        ]);

    }

    public function render()
    {
        return view('livewire.board.template.create-board-from-template-form');
    }

}
