<?php

namespace App\Livewire\Cms2\App;

use Livewire\Attributes\Url;
use Livewire\Component;

class Breadcrumb extends Component
{

    public $menu = [];

    #[Url]
    public $board_id = '';

    public function mount(){
        foreach($this->menu as $m ){
            $m['route-var']['board_id'] = $this->board_id;
        }
    }
    public function render()
    {
        return view('livewire.cms2.app.breadcrumb');
    }
}
