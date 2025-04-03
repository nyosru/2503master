<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedColumn;
use Livewire\Component;

class CreateColumnForm extends Component
{
    public $name;
    public $board_id;


    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        $in = [
            'name' => $this->name,
            'board_id' => $this->board_id,
        ];
        LeedColumn::create($in);

        $this->reset('name');
        $this->dispatch('refreshLeedBoardComponent');
        session()->flash('message', 'Колонка создана.');
    }

    public function render()
    {
        return view('livewire.cms2.leed.create-column-form');
    }

}
