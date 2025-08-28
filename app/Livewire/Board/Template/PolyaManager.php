<?php

namespace App\Livewire\Board\Template;

use App\Models\BoardTemplatePolya;
use Livewire\Component;

class PolyaManager extends Component
{

    public $board_template_id;

    public $polya = [];
    public $name;
    public $description;
    public $pole;
    public $sort = 50;
    public $is_enabled = true;
    public $show_on_start = false;
    public $in_telega_msg = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'pole' => 'required|string|max:255',
        'sort' => 'required|integer|min:0|max:99',
        'is_enabled' => 'boolean',
        'show_on_start' => 'boolean',
        'in_telega_msg' => 'boolean',
    ];

    public function mount($board_template_id)
    {
        $this->board_template_id = $board_template_id;
        $this->loadPolya();
    }

    public function loadPolya()
    {
        $this->polya = BoardTemplatePolya::where('board_template_id', $this->board_template_id)
            ->orderBy('sort','desc')
            ->get();
    }

    public function addPolya()
    {
        $this->validate();

        BoardTemplatePolya::create([
            'board_template_id' => $this->board_template_id,
            'name' => $this->name,
            'description' => $this->description,
            'pole' => $this->pole,
            'sort' => $this->sort,
            'is_enabled' => $this->is_enabled,
            'show_on_start' => $this->show_on_start,
            'in_telega_msg' => $this->in_telega_msg,
        ]);

        $this->reset(['name', 'description',  'pole', 'sort', 'is_enabled', 'show_on_start', 'in_telega_msg']);
        $this->sort = 50;
        $this->loadPolya();
    }

    public function deletePolya($id)
    {
        BoardTemplatePolya::where('id', $id)->delete();
        $this->loadPolya();
    }

    public function render()
    {
        return view('livewire.board.template.polya-manager');
    }
}
