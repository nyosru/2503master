<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecordOrder;
use Livewire\Component;

class ItemOrderButtonRes extends Component
{
    public $i;
    public $msgClose;
    public $newStatus;

    public function mount(LeedRecordOrder $i){
        $this->i = $i;
    }

    public function setStatus($new_status = '')
    {
        if( !empty($new_status) )
            $this->newStatus = $new_status;

//        dd($this->msgClose);
        $this->i->status = $this->newStatus;
        $this->i->close_comment = $this->msgClose;
        $this->i->close_at = now();
        $this->i->save();
        $this->dispatch('refreshLeedItem');
    }

    public function render()
    {
        return view('livewire.cms2.leed.item-order-button-res');
    }
}
