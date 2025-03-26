<?php

namespace App\Livewire\Cms2\Task;

use App\Models\Task;
use Livewire\Component;

class Create extends Component
{

    public $taskId;
    public $name;
    public $comment;
    public $date;
    public $time;
    public $lead;

    protected $rules = [
        'name' => 'required|string|max:255',
        'comment' => 'nullable|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'lead' => 'nullable|exists:leads,id',
    ];

    public function mount($taskId = null)
    {
        if ($taskId) {
            $this->taskId = $taskId;
            $task = Task::find($taskId);
            if ($task) {
                $this->name = $task->name;
                $this->comment = $task->comment;
                $this->date = $task->date;
                $this->time = $task->time;
                $this->lead = $task->lead_id;
            }
        }
    }

    public function save()
    {
        $this->validate();

        Task::updateOrCreate(
            ['id' => $this->taskId],
            [
                'name' => $this->name,
                'comment' => $this->comment,
                'date' => $this->date,
                'time' => $this->time,
                'lead' => $this->lead,
            ]
        );

        session()->flash('message', $this->taskId ? 'Задача обновлена!' : 'Задача добавлена!');
        return redirect()->route('task.manager');
    }
    public function render()
    {
//        $leads = Lead::all();
        $leads = [];
        return view('livewire.cms2.task.create', compact('leads'));
    }
}
