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

    public function search(): object
    {
        $this->reset(['orgData', 'error']);

        $req = new DadataOrgController();
//        $req->inn = $this->inn;
        $response0 = $req->findPartyByInn($this->inn);
        $orgData = json_decode($response0);
        if (!empty($orgData->suggestions)) {
            dd($orgData->suggestions);
        }

        return $orgData->suggestions;

        //dd($response);
//        $response = Http::post(route('dadata.find-org'), [
//            'inn' => $this->inn,
//        ]);
//        dd($response->json());
//        $response = Http::get('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party', [
//            'query' => $this->inn,
//            'count' => 1,
//            'locations' => 'Россия',
//            'from_bound' => ['value' => 'cities'],
//            'to_bound' => ['value' => 'cities'],
//        ]);

//        if ($response->ok()) {
//            $this->orgData = $response->json();
//        } else {
//            $this->error = $response->json('error') ?? 'Ошибка поиска';
//        }
    }

    public function render()
    {
        return view('livewire.service.dadata-org-search-component');
    }
}
