<?php

namespace App\Livewire\Cms2\App;

use Livewire\Component;

class Breadcrumb extends Component
{

    public $menu = [];

    public function render()
    {
        return view('livewire.cms2.app.breadcrumb');
    }
}
