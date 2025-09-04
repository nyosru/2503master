<?php

namespace App\Livewire\App;

use Livewire\Component;

class AuthLink extends Component
{

    public $show_original_link;
    public $link_to_auth_master_domain = '';

    public function mount()
    {
        $value = env('APP_URL');
        $parsed2 = parse_url(trim($value));
        $APP_URL = strtolower($parsed2['host'] ?? '' );

        $domain_now = strtolower($_SERVER['HTTP_HOST']);

        $this->show_original_link = ( $APP_URL == $domain_now );
        $this->link_to_auth_master_domain = 'https://'.$APP_URL.'/enter/tg?return_to='.urlencode($domain_now);
    }

    public function render()
    {
        return view('livewire.app.auth-link');
    }
}
