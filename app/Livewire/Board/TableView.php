<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableView extends Component
{
    use WithPagination;

    public Board $board;
    public $columns;
    public $selectedColumnId;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 20;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'selectedColumnId' => ['except' => ''],
    ];

    public function mount(Board $board)
    {
        $this->board = $board;
        $this->columns = $board->columns()->orderBy('order')->get();

        // Устанавливаем первый столбец по умолчанию, если не выбран
        if ($this->columns->isNotEmpty() && !$this->selectedColumnId) {
            $this->selectedColumnId = $this->columns->first()->id;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedColumnId()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getRecordsProperty()
    {
        if (!$this->selectedColumnId) {
            return collect();
        }

        $query = LeedRecord::with(['user', 'client', 'order'])
            ->where('column_id', $this->selectedColumnId)
            ->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('client', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });

        return $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getSelectedColumnProperty()
    {
        return $this->columns->firstWhere('id', $this->selectedColumnId);
    }

    public function moveToColumn($recordId, $newColumnId)
    {
        $record = LeedRecord::find($recordId);

        if ($record && Auth::user()->can('move', $record)) {
            $record->update(['column_id' => $newColumnId]);
            session()->flash('success', 'Запись перемещена успешно!');
        } else {
            session()->flash('error', 'Не удалось переместить запись!');
        }
    }

    public function render()
    {
        return view('livewire.board.table-view', [
            'records' => $this->records,
            'selectedColumn' => $this->selectedColumn,
        ]);
    }
}
