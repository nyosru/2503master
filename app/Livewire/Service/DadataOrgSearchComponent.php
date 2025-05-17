<?php

namespace App\Livewire\Service;

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

        $response = Http::post(route('dadata.find-org'), [
            'inn' => $this->inn,
        ]);

//        $response = Http::get('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party', [
//            'query' => $this->inn,
//            'count' => 1,
//            'locations' => 'Россия',
//            'from_bound' => ['value' => 'cities'],
//            'to_bound' => ['value' => 'cities'],
//        ]);

        if ($response->ok()) {
            $this->orgData = $response->json();
        } else {
            $this->error = $response->json('error') ?? 'Ошибка поиска';
        }
    }

    public function render()
    {
        return view('livewire.service.dadata-org-search-component');
    }
}
