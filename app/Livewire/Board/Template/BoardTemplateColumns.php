<?php

namespace App\Livewire\Board\Template;

use App\Models\BoardColumnTemplate;
use App\Models\BoardTemplate;
use Livewire\Component;

class BoardTemplateColumns extends Component
{


    public $template;
    public $template_id;
    public $columns;
    public $templateName;
    public $newColumnName;
    public $newPositionName;
    public $sorting = 50;


    protected $rules = [
        'templateName' => 'required|string|max:255',
        'newColumnName' => 'nullable|string|max:255',
        'newPositionName' => 'nullable|string|max:255',
        'sorting' => 'required|number|main:1|max:99',
    ];


    public function mount( $template_id ){
        $this->columns = BoardTemplate::find($this->template_id)->columns->toArray();
    }


    public function addColumn()
    {
        $this->validateOnly('templateName,newColumnName,sorting');

//        if($this->selectedTemplateId && $this->newColumnName) {
            BoardColumnTemplate::create([
                'board_template_id' => $this->template_id,
                'name' => $this->newColumnName,
//                'sorting' => 50,
                'sorting' => $this->sorting,
                'extra_params' => [],
                'description' => null,
            ]);
            $this->newColumnName = '';
            $this->refreshColumns();
//        }
    }


    protected function refreshColumns()
    {
        $this->columns = BoardColumnTemplate::where('board_template_id', $this->template_id)->get()->toArray();
    }

    public function deleteColumn($columnId)
    {
        BoardColumnTemplate::where('id', $columnId)->delete();
        $this->refreshColumns();
    }


    public function render()
    {
        return view('livewire.board.template.board-template-columns');
    }
}
