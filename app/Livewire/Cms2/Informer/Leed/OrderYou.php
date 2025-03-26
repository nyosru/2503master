<?php

namespace App\Livewire\Cms2\Informer\Leed;

use App\Models\LeedRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderYou extends Component
{
    public $leed;
    public $ordersCount;
    public $ordersCountTotal;


    public function mount(LeedRecord $leed)
    {
        $this->leed = $leed;
        $user_id = Auth::id();

        $this->ordersCount = $this->leed->orders()
            ->where('status', 'новая')
            ->where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereNull('reminder_at')
                    ->orWhere('reminder_at', '<', now());
            })
            ->count();
        $this->ordersCountTotal = $this->leed->orders()
            ->where('user_id', $user_id)
            ->count();
    }


    public function render()
    {
        return view('livewire.cms2.informer.leed.order-you');
    }
}
