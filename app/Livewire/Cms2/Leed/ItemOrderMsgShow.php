<?php

namespace App\Livewire\Cms2\Leed;

use Livewire\Component;

class ItemOrderMsgShow extends Component
{

    // пользователь
    public $user;
    // дата время
    public $at;
    // сообщение
    public $msg;
//    автор или нет
    public $thisAutor;

    public function mount(){
        $this->thisAutor = ( $this->user->id == auth()->id() );
    }
    public function render()
    {
        return view('livewire.cms2.leed.item-order-msg-show');
    }
}
