<?php

namespace App\Livewire\Column;

use Livewire\Component;

class ConfigMacroItemShow extends Component
{
    /**
     * @var
     */
    public $item;

    public function render()
    {
        return view('livewire.column.config-macro-item-show');
    }
}
