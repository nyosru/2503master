<?php

namespace App\Livewire\Cms2\Leed;

use Livewire\Component;

class ColumnItem extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.cms2.leed.column-item');
    }
}
