<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\Logs2;
use Livewire\Component;

class ItemLog extends Component
{

    public $items ;
    public $leed_record_id;


    public function load(){

        $this->items = Logs2::where('leed_record_id', $this->leed_record_id)
//            ->when($this->showTehComment, function ($query) {
//                // Показываем записи с type NULL или 'tech'
//                $query->where(function ($subQuery) {
//                    $subQuery->whereNull('type')
//                        ->orWhere('type', 'tech');
//                });
//            }, function ($query) {
//                // Показываем записи с type NULL или не равным 'tech'
//                $query->where(function ($subQuery) {
//                    $subQuery->whereNull('type')
//                        ->orWhere('type', '!=', 'tech');
//                });
//            })
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public function render()
    {
        $this->load();
        return view('livewire.cms2.leed.item-log',['items'=>$this->items]);
    }
}
