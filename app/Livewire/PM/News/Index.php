<?php

namespace App\Livewire\PM\News;

use App\Models\News;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    /**
     * показ фильтров
     * @var bool
     */
    public $showFilter = true;
    /**
     * показывать постраничную навигацию
     * @var bool
     */
    public $showPages = true;
    /**
     * показывать ссылку на раздел в заголовке
     * @var bool
     */
    public $showLinkInHead = false;
    public $page ;
    public $search = '';
    public $sortField = 'published_at';
    public $sortDirection = 'desc';
    public $showDomain = '';
    public $showBoardId = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'published_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

//    public function updatingSearch()
//    {
//        $this->resetPage();
//    }

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

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {

//        public $showDomain = '';
//        public $showBoardId = '';

        $domain = $this->showDomain;

        $host = Request::getHost();
        if ($host === 'master.local') {
            $domain = 'master.local';
        }
        elseif( ( $_SERVER['HTTP_HOST'] ?? '' ) == 'master.local' ) {
            $domain = 'master.local';
        }

        $news = News::published()

            ->with('board.domain')
            ->when($domain, function ($query) use ($domain) {
                $query->whereHas('board.domain', function ($query) use ($domain) {
                    $query->where('domain', $domain);
                });
            })

//                ->with('board.domain')
//                ->whereHas('board.domain', function ($query) use ( $domain) {
//                    $query->where('domain', $domain);
//                })
//                ->get()
//            ->when($this->showDomain, function ($query) {
////                $query->where('domain', $this->showDomain);
//            })
//            ->when($this->showBoardId, function ($query) {
////                $query->where('domain', $this->showDomain);
//            })

            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.p-m.news.index', [
            'news' => $news,
        ]);
    }
}
