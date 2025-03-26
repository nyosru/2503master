<?php

namespace App\Livewire\Cms2\Order;

use App\Models\Order;
use Livewire\Component;

class Item extends Component
{
    public $order;
    public $order_id;

    public function mount(){
        $this->order = Order::whereId($this->order_id)->first();
    }
    public function render()
    {
        return view('livewire.cms2.order.item',
        [
            'order' => $this->order
        ]);
    }
}
