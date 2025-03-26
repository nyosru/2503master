<?php

namespace App\Livewire\Cms2;

use App\Models\Contract;
use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Contracts extends Component
{


    use WithPagination,WithoutUrlPagination;

//    protected $paginationTheme = 'bootstrap';
//    public $orders;

//    #[Url(history: true)]
    public ?string $searchTerm = '';

    public $visible = [];
//    public $searchTerm;
//    public $users;
//    #[Url(as:'page',history: true)]
    public $currentPage = 1;


    protected function queryString()
    {
        return [
            'searchTerm' => [
                'as' => 's',
            ],
        ];
    }

//    public function render()
//    {
//
//
//        return view('livewire.cms2.buh-scheta', compact('orders'));
//    }

//    public function changeVisible($id)
//    {
//        if (!isset($this->visible[$id])) {
//            $this->visible[$id] = 1;
//        } else {
//            $this->visible[$id] = 1 ? 0 : 1;
//        }
//        $this->resetPage();
//    }

    public function updatingSearchTerm( \Request $request )
    {
//        $request->fullUrlWithQuery(['search' => $this->searchTerm]);
        $this->resetPage();
//        Paginator::currentPageResolver(function () {
//            return $this->currentPage;
//        });
    }
//
    public function setPage($url)
    {
////        dd($url);
        if( is_numeric($url)) {
            $this->currentPage = $url;
        }
//        else {
//            $this->currentPage = explode('page=', $url)[1];
//        }
//
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function render()
    {

//        $items = Contract::with('client')
//            ->whereHas('client', function ($query) {
//                $query->where(function ($q) {
//                    $q->where('name_i', 'like', '%' . $this->searchTerm . '%')
//                        ->orWhere('name_f', 'like', '%' . $this->searchTerm . '%')
//                        ->orWhere('name_o', 'like', '%' . $this->searchTerm . '%');
//                });
//            })
//            ->orderByDesc('id')
//            ->paginate(10);
        $items = Contract::with('order','order.client')->orderByDesc('id')
            ->paginate(10);

        return view(
//            'livewire.cms2.buh-zakaz',
            'livewire.cms2.contracts',
            compact('items')
//            ['orders' => $orders, 'paginator' => $orders]
        )//            ->layout('livewire.cms2.buh-pagination')
            ;
    }

//    public function render()
//    {
//        return view('livewire.cms2.contracts');
//    }
}
