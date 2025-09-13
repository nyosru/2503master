<?php

namespace App\Livewire\Board\Template;

use App\Models\BoardTemplate;
use Livewire\Component;

class BoardTemplateColumns extends Component
{


    public $template;
    public $template_id;
    public $columns;

    public function mount( $template_id ){
        $this->columns = BoardTemplate::find($this->template_id)->columns->toArray();
    }

    public function render()
    {
        return view('livewire.board.template.board-template-columns');
    }
}
