<?php

namespace App\Livewire\Cms2\Order;

use App\Models\OrderLabel;
use Livewire\Component;

class OrderLabelManager extends Component
{
    public $name;
    public $color = '#ffffff';
    public $text_color = '#000000';
    public $labels;

    public function mount()
    {
        $this->labels = OrderLabel::all();
    }

    public function createLabel()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'text_color' => 'required|string|max:7',
        ]);

        OrderLabel::create([
            'name' => $this->name,
            'color' => $this->color,
            'text_color' => $this->text_color,
            'staff_id' => auth()->id(),
            'add_ts' => now(),
        ]);

        $this->reset(['name', 'color', 'text_color']);
        $this->labels = OrderLabel::all();
    }

    public function deleteLabel($id)
    {
        OrderLabel::findOrFail($id)->delete();
        $this->labels = OrderLabel::all();
    }

    public function render()
    {
        return view('livewire.cms2.order.order-label-manager');
    }
}
