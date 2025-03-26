<?php

namespace App\Livewire\Cms2\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Manager extends Component
{
    use WithPagination; // Включаем пагинацию

    protected $tasks;

    // Количество элементов на странице
    protected $paginationTheme = 'tailwind'; // Используем стандартную пагинацию Tailwind

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->delete(); // Удаляем задачу
            session()->flash('message', 'Задача удалена!');
        }
    }

    public function load()
    {
        $this->tasks = Task::orderBy('add_ts','desc')->paginate(15);
    }

    public function render()
    {
        $this->load();
        return view('livewire.cms2.task.manager',['tasks'=>$this->tasks]);
    }
}
