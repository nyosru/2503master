<?php

namespace App\Livewire\Cms2\App;

use Livewire\Attributes\Url;
use Livewire\Component;

class Breadcrumb extends Component
{

    public $menu = [];
    public $board_id = '';

    public function mount(){
        foreach($this->menu as $k => $m ){

            if( !isset($this->menu[$k]['route-var']) )
                $this->menu[$k]['route-var'] = [];

            $this->menu[$k]['route-var']['board_id'] = $this->board_id ?? 0;

        }
    }
    public function render()
    {
        return view('livewire.cms2.app.breadcrumb');
    }
}
