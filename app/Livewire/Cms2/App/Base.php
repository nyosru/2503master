<?php

namespace App\Livewire\Cms2\App;

use Livewire\Component;

class Base extends Component
{
    public $pass;

    public function render()
    {
        return view('livewire.cms2.app.base');
    }
}
