<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedColumn;
use Livewire\Component;

class CreateColumnForm extends Component
{
    public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        LeedColumn::create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        session()->flash('message', 'Column created successfully.');
    }

    public function render()
    {
        return view('livewire.cms2.leed.create-column-form');
    }

}
