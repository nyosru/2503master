<?php

namespace App\Livewire\Cms2\Client;

use App\Models\Client;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination,WithoutUrlPagination;

    #[Url]
    public $searchTerm = ''; // Поле для поиска

    protected $items;

    #[Url(as:'page')]
    public $currentPage = 1;

    #[Url]
    public $return_url;
    #[Url]
    public $return_leed;

    public $itemsOnPage = 10;


//    public function getITems(){
//        $this->items = Client::
////            with('client')
////            ->whereHas('client', function ($query) {
////                $query->where(function ($q) {
////                    $q->where('name_i', 'like', '%' . $this->searchTerm . '%')
////                        ->orWhere('name_f', 'like', '%' . $this->searchTerm . '%')
////                        ->orWhere('name_o', 'like', '%' . $this->searchTerm . '%');
////                });
////            })
////            ->
//        orderByDesc('id')
//            ->paginate(10);
//    }

    public function getItems()
    {
        $this->items = Client::query()
            ->where(function ($query) {
                $query->where('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('ur_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('ur_name', 'like', $this->searchTerm . '%')
                    ->orWhere('name_company', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name_company', 'like', $this->searchTerm . '%')
                    ->orWhere('name_i', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name_i', 'like', $this->searchTerm . '%')
                    ->orWhere('name_f', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name_f', 'like',  $this->searchTerm . '%')
                    ->orWhere('name_o', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('name_o', 'like',  $this->searchTerm . '%');
            })
            ->orderByDesc('id')
            ->paginate($this->itemsOnPage);

        // Проверка на количество найденных записей
//        if ($this->items->count() === 0) {
//            // Если нет результатов, сбрасываем текущую страницу на 1
//            $this->resetPage();
//        }

    }

//    public function getItems()
//    {
//        $this->items = Client::query()
//            ->where(function ($query) {
//                // Разделяем поисковый термин на отдельные слова
//                $terms = explode(' ', $this->searchTerm);
//
//                foreach ($terms as $term) {
//                    $query->where(function ($q) use ($term) {
//                        $q->where('phone', 'like', '%' . $term . '%')
//                            ->orWhere('email', 'like', '%' . $term . '%')
//                            ->orWhere('ur_name', 'like', '%' . $term . '%')
//                            ->orWhere('name_company', 'like', '%' . $term . '%')
//                            ->orWhere('name_i', 'like', '%' . $term . '%')
//                            ->orWhere('name_f', 'like', '%' . $term . '%')
//                            ->orWhere('name_o', 'like', '%' . $term . '%');
//                    });
//                }
//            })
//            ->orderByDesc('id')
//            ->paginate(10);
//    }

//    public function updatedSearchTerm()
    public function goSearch()
    {
//        sleep(100);
//        $this->resetPage(); // Сброс страницы при изменении поискового термина
//        $this->currentPage = 1;
//        $this->getItems(); // Обновление списка клиентов
        return redirect()->to(route('clients',[
            'page'=>1,
            'searchTerm'=>$this->searchTerm,
            'return_url' => $this->return_url,
            'return_leed' => $this->return_leed,
        ])); // Переход на первую страницу с параметрами
    }

    public function mount()
    {
        $this->getITems();
    }


    public function setPage($url)
    {
        if (is_numeric($url)) {
            Paginator::currentPageResolver(function () use ($url) {
                return $url;
            });
        }
        $this->getItems();
    }


    public function render()
    {
        return view('livewire.cms2.client.clients')
            ->with(['items' => $this->items])
            ->layoutData([
                'searchTerm' => $this->searchTerm,
                'return_url' => $this->return_url,
                'return_leed' => $this->return_leed
            ]); // Передаем searchTerm в представление

    }
}
