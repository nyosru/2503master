<?php

namespace App\Livewire\Cms2\Order;

use App\Http\Controllers\OrderLabelController;
use App\Models\OrderLabel;
use Livewire\Component;

class OrderLabelBlock extends Component
{
    public $labels;
    public $label_new;
    public $labels_selected;

    public function mount()
    {
//        $this->labels = OrderLabel::all();
//        $this->labels = OrderLabelController::get();
        $this->loadMetki();
    }

    public function loadMetki()
    {
//        $this->labels = OrderLabel::all();
        $this->labels = OrderLabelController::get();
    }

    public function deleteBaseLabel(int $metka_id)
    {
        OrderLabelController::hide($metka_id);
        $this->loadMetki();
//        dd(['удалить',$metka_id]);
    }

    public function addToCreateOrder(int $metka_id)
    {
//        dd( $metka_id);
        $this->dispatch('addMetka', $metka_id);
//        $this->dispatch('loadColumns');
    }

    public function save()
    {
        $new = OrderLabelController::add($this->label_new);

        if (!empty($new->id)) {
            $this->dispatch('addMetka', $new->id);
//            OrderLabelController::show($metka_id);
        }
//        dd($new);
        $this->loadMetki();
        // Эмитируем событие для обновления других компонентов, если необходимо
//        $this->dispatch('loadColumns');

        session()->flash('successLabel', 'Метка "' . $this->label_new . '" успешно добавлена');

        $this->reset('label_new');

        return $new;
    }

    public function render()
    {
        return view('livewire.cms2.order.order-label-block');
    }
}
