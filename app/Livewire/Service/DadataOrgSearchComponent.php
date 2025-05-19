<?php

namespace App\Livewire\Service;

use App\Http\Controllers\Service\DadataOrgController;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DadataOrgSearchComponent extends Component
{

    public $inn = '';
    public $orgData = null;
    public $error = null;

    public function search()
    {

        $this->reset(['orgData', 'error']);

        $req = new DadataOrgController();
        $ee = $req->findPartyByInn($this->inn);
        if (!empty($ee['suggestions'][0])) {
            $this->orgData = $ee['suggestions'][0];
        }

//        return $this->orgData['suggestions'];

    }

    public function render()
    {
        return view('livewire.service.dadata-org-search-component');
    }
}
