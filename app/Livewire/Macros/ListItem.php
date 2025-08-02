<?php

namespace App\Livewire\Macros;

use Livewire\Component;

class ListItem extends Component
{

    public $item;

    public function render()
    {
        return view('livewire.macros.list-item');
    }
}
