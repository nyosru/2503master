<?php

namespace App\Livewire\Vk;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Friend extends Component
{

    public $friends = [];
    public $error = '';

    protected function loadFriends($accessToken)
    {
        $response = Http::get('https://api.vk.com/method/friends.get', [
            'access_token' => $accessToken,
            'v' => '5.131',
            'fields' => 'photo_100,domain'
        ]);

        if (isset($response->json()['response']['items'])) {
            $this->friends = $response->json()['response']['items'];
        } else {
            $this->error = 'Не удалось загрузить список друзей';
        }
    }

    public function render()
    {
//        Auth::user()->accessToken = $accessToken = Auth::user()->accessToken;
        dd( [ Auth::user()->accessToken,
        Auth::user() ] );
        return view('livewire.vk.friend');
    }
}
