<?php

namespace App\Livewire\Informer;

use Livewire\Component;

class EmailFormatter extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.informer.email-formatter');
    }
}
