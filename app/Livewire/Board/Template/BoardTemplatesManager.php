<?php

namespace App\Livewire\Board\Template;

use App\Models\BoardColumnTemplate;
use App\Models\BoardPositionTemplate;
use App\Models\BoardTemplate;
use Livewire\Attributes\Url;
use Livewire\Component;

class BoardTemplatesManager extends Component
{

    #[Url]
    public $selectedTemplateId = null;
    public $nowTemplate;

    public $templates;
    public $columns = [];
    public $positions = [];

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

    public function mount()
    {
        $this->loadTemplates();

        if( !empty($this->selectedTemplateId) ) {
            $this->selectTemplate($this->selectedTemplateId);
        }

    }

    public function loadTemplates()
    {
        $this->templates = BoardTemplate::all();
    }

    public function selectTemplate($id)
    {

        $this->selectedTemplateId = $id;
        $this->nowTemplate = BoardTemplate::with([
            'columns' => function($query) {
                $query->orderBy('sorting', 'asc');
            },
            'positions'
        ])->find($id);
        $this->templateName = $this->nowTemplate->name;
        $this->columns = $this->nowTemplate->columns->toArray();
        $this->positions = $this->nowTemplate->positions->toArray();

    }

    public function saveTemplate()
    {
        $this->validateOnly('templateName');

        if ($this->selectedTemplateId) {
            $template = BoardTemplate::find($this->selectedTemplateId);
            $template->update([
                'name' => $this->templateName
            ]);
        } else {
            $template = BoardTemplate::create([
                'name' => $this->templateName,
            ]);
            $this->loadTemplates();
            $this->selectedTemplateId = $template->id;
        }
    }

    public function addColumn()
    {
        $this->validateOnly('newColumnName,sorting');

        if($this->selectedTemplateId && $this->newColumnName) {
            BoardColumnTemplate::create([
                'board_template_id' => $this->selectedTemplateId,
                'name' => $this->newColumnName,
//                'sorting' => 50,
                'sorting' => $this->sorting,
                'extra_params' => [],
                'description' => null,
            ]);
            $this->newColumnName = '';
            $this->refreshColumns();
        }
    }

    public function deleteColumn($columnId)
    {
        BoardColumnTemplate::where('id', $columnId)->delete();
        $this->refreshColumns();
    }

    public function addPosition()
    {
        $this->validateOnly('newPositionName');

        if($this->selectedTemplateId && $this->newPositionName) {
            // Предполагается модель BoardPositionTemplate с полями board_template_id и name
            BoardPositionTemplate::create([
                'board_template_id' => $this->selectedTemplateId,
                'name' => $this->newPositionName,
            ]);
            $this->newPositionName = '';
            $this->refreshPositions();
        }
    }

    public function deletePosition($positionId)
    {
        BoardPositionTemplate::where('id', $positionId)->delete();
        $this->refreshPositions();
    }

    protected function refreshColumns()
    {
        $this->columns = BoardColumnTemplate::where('board_template_id', $this->selectedTemplateId)->get()->toArray();
    }

    protected function refreshPositions()
    {
        $this->positions = BoardPositionTemplate::where('board_template_id', $this->selectedTemplateId)->get()->toArray();
    }


    public function render()
    {
        return view('livewire.board.template.board-templates-manager');
    }
}
