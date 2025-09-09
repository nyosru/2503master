<?php

namespace App\Livewire\PM\NewsAdmin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortField = 'published_at';
    public $sortDirection = 'desc';
    public $boardFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'published_at'],
        'sortDirection' => ['except' => 'desc'],
        'boardFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBoardFilter()
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
        $this->resetPage();
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        session()->flash('success', 'Новость успешно удалена');
    }

    public function togglePublish($id)
    {
        $news = News::findOrFail($id);
        $news->update([
            'is_published' => !$news->is_published,
            'published_at' => $news->is_published ? null : now()
        ]);

        session()->flash('success', 'Статус публикации изменен');
    }

    public function render()
    {
        $news = News::with(['author', 'board'])

            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->boardFilter, function ($query) {
                if ($this->boardFilter === 'without') {
                    $query->whereNull('board_id');
                } else {
                    $query->where('board_id', $this->boardFilter);
                }
            })

            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.p-m.news-admin.index', [
            'news' => $news,
            'boards' => \App\Models\Board::all()
        ]);
    }
}
