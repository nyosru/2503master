<?php

namespace App\Livewire\App;

use Livewire\Component;

class MenuItem extends Component
{

    public $route;
    public $active;
    public $name;
    public $img;

    public function render()
    {
        return view('livewire.app.menu-item');
    }
}
