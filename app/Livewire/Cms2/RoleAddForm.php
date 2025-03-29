<?php

namespace App\Livewire\Cms2;

use App\Models\LeedColumn;
use App\Models\Role;
use Livewire\Component;

class RoleAddForm extends Component
{
    #[Rule('required|string|min:3')]
    public $name;


    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        Role::create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        session()->flash('message', 'Column created successfully.');
    }


    public function render()
    {
        return view('livewire.cms2.role-add-form');
    }
}
