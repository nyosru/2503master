<?php

namespace App\Livewire\Cms2\Informer\Leed;

use Livewire\Component;

class Order extends Component
{
    public $leed;
    public $count;
    public $virtual_order_id;

    public $showModalCreateOrder;
    public function changeVisibleCreateOrderForm($id)
    {
        $this->showModalCreateOrder[$id] = (isset($this->showModalCreateOrder[$id]) && $this->showModalCreateOrder[$id] === true) ? false : true;
    }


    public function countKolvoOrders(){

//        if(!empty($this->leed->id))
//        {
//            $count = LeedRecord::where('status', 'новая')
//                ->whereHas('tasks', function ($query) {
//                    // Если у вас есть дополнительные условия для задач, добавьте их сюда
//                })
//                ->count();
//        }

    }


    public function render()
    {
//        dd($this->leed);
        try {
            $ord = \App\Models\Order::whereId($this->leed->order_id)->select('virtual_order_id')->firstOrFail();
            $this->virtual_order_id = $ord->virtual_order_id;
        }catch (\Exception $e){}
//        dd($ord);

        return view('livewire.cms2.informer.leed.order');
    }
}
