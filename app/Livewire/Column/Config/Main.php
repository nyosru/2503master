<?php

namespace App\Livewire\Column\Config;

use App\Models\LeedColumn;
use Livewire\Component;

class Main extends Component
{
    public $settings;
    public function mount(LeedColumn $column){

        $this->settings = [
            'name' => $column->name,
            'can_move' => $column->can_move,
            'can_delete' => $column->can_delete,
            'type_otkaz' => $column->type_otkaz,
            'can_create' => $column->can_create,
            'can_transfer' => $column->can_transfer,
            'can_get' => $column->can_get,
//            'can_accept_contract' => $column->can_accept_contract,
        ];

    }
    public function render()
    {
        return view('livewire.column.config.main');
    }
}
