<?php

namespace App\Livewire\Cms2\Informer;

use Livewire\Component;

class ClientBasic extends Component
{
    public $i;
    public $full = true;

    public function render()
    {
        return view('livewire.cms2.informer.client-basic');
    }
}
