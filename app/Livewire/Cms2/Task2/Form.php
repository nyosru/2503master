<?php

namespace App\Livewire\Cms2\Task2;

use App\Models\LeedRecord;
use App\Models\Order;
use App\Models\Task2;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public ?Task2 $task;
    public $taskData = [
        'parent_id' => null,
        'name' => '',
        'description' => '',
        'autor_id' => null,
        'worker_id' => null,
        'start_at' => null,
        'due_at' => null,
        'leed_record_id' => null,
        'order_id' => null,
        'viewed' => false,
        'completed' => false,
        'approved' => false,
    ];

    public function mount($task_id = null)
    {
        if ($task_id) {
            $this->task = Task2::findOrFail($task_id);
            $this->taskData = $this->task->toArray();
        }
    }


    protected function rules()
    {
        return [
            'taskData.name' => 'required|string|max:255',
            'taskData.description' => 'required|string',
            'taskData.autor_id' => 'nullable|exists:users,id',
            'taskData.worker_id' => 'nullable|exists:users,id',
            'taskData.start_at' => 'nullable|date',
            'taskData.due_at' => 'nullable|date',
            'taskData.leed_record_id' => 'nullable|exists:leed_records,id',
            'taskData.order_id' => 'nullable|exists:orders,id',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if (!empty($this->task)) {
            $this->task->update($validated['taskData']);
        } else {
            Task2::create($validated['taskData']);
        }

        session()->flash('message', 'Задача успешно сохранена.');
        return redirect()->route('tech.task2');
    }

    public function render()
    {
        return view('livewire.cms2.task2.form', [
            'users' => User::all(),
            'orders' => Order::all(),
            'leedRecords' => LeedRecord::all(),
        ]);
    }
}
