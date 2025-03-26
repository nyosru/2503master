<?php

namespace App\Livewire\Cms2\Informer;

use App\Models\Cms1\Clients;
use Livewire\Component;

class ForAddLeedClientInfoMini extends Component
{
    public $client_id;
    public $client;

    public function mount(){
        $this->client = Clients::find($this->client_id);
    }

    public function updateClient_id(){
        $this->client = Clients::find($this->client_id);
    }
    public function render()
    {
        return view('livewire.cms2.informer.for-add-leed-client-info-mini');
    }
}
