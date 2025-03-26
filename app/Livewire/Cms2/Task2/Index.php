<?php

namespace App\Livewire\Cms2\Task2;

use App\Models\Task;
use App\Models\Task2;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; // Включаем пагинацию

    protected $tasks;

    public function mount(){
        $this->load();
    }
    public function load()
    {
        $this->tasks = Task2::latest()->paginate(15);
    }

    public function render()
    {
        return view('livewire.cms2.task2.index',[
            'tasks' => $this->tasks
        ]);
    }
}
