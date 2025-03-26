<?php

namespace App\Livewire\Cms2;

use App\Models\Client;
use App\Models\Role;
use App\Models\Staff as modelStaff;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Staff extends Component
{
    use WithPagination;

    // Свойства фильтров, синхронизированные с URL
    #[Url]
    public $searchDepartment = '';
    #[Url]
    public $searchEmail = '';

    public $show_all_info = false;

    #[Url]
    public $page = 1; // Для управления страницей через URL
    protected $paginationTheme = 'tailwind';

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['searchName', 'searchEmail'])) {
            $this->resetPage(); // Сбрасываем пагинацию при обновлении фильтров
        }
    }

    public function render()
    {
        $query = modelStaff::query();

        if (!empty($this->searchName)) {
            $query->where('department', 'like', '%' . $this->searchDepartment . '%');
        }

//        if (!empty($this->searchEmail)) {
//            $query->where('email', 'like', '%' . $this->searchEmail . '%');
//        }

        $items = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.cms2.staff'
            , ['items' => $items]
        );
    }
}
//    use WithPagination,WithoutUrlPagination;
//
//    protected $items;
//
//    #[Url]
//    public $currentPage = 1;
//
//    // показ всех доп полей в таблице
//    public $show_all_info = false;
//    // Свойство для выбранной должности
//
//    #[Url]
//    public $selectedPosition = null;
//
//    #[Url]
//    public $position = null;
//
//    #[Url]
//    public $currentPosition = null;
//
////    #[Url]
////    public $currentPosition = null;
//
//    public function mount()
//    {
//        $this->getITems();
//    }
//
//    public function selectPosition($new){
////        dd(1);
//        $this->position = $new;
//        $this->resetPage(); // Сбросить пагинацию при изменении фильтра
//        $this->getITems();
//    }
//
//    public function updatedPosition($new){
//        dd(1);
//        $this->position = $new;
//        $this->resetPage(); // Сбросить пагинацию при изменении фильтра
//        $this->getITems();
//    }
//
//    public function getITems(){
//        $query = \App\Models\Staff::query();
//
////        if (!empty($this->selectedPosition)) {
////            $query->where('department', $this->selectedPosition);
////        }
////        else
//            if (!empty($this->position)) {
//            $query->where('department', $this->position);
//        }
////        elseif (!empty($this->currentPosition)) {
////            $query->where('department', $this->currentPosition);
////        }
//
////        $this->items = \App\Models\Staff::
////            with('client')
////            ->whereHas('client', function ($query) {
////                $query->where(function ($q) {
////                    $q->where('name_i', 'like', '%' . $this->searchTerm . '%')
////                        ->orWhere('name_f', 'like', '%' . $this->searchTerm . '%')
////                        ->orWhere('name_o', 'like', '%' . $this->searchTerm . '%');
////                });
////            })
////            ->
//        $this->items = $query->orderByDesc('id')
//            ->paginate(10);
//    }
//
//    // Метод для выбора должности
////    public function selectPosition($position)
////    {
////        $this->selectedPosition = $position;
////        if( empty($position) )
////            $this->setPage(1);
////
////        // Перенаправляем с параметром в URL
//////        return redirect()->route('staff.index', ['position' => $this->selectedPosition]);
////        $this->getITems();
////    }
//
//    public function setPage($url)
//    {
//////        dd($url);
//        if( is_numeric($url)) {
//            $this->currentPage = $url;
//        }
////        else {
////            $this->currentPage = explode('page=', $url)[1];
////        }
////
//        Paginator::currentPageResolver(function () {
//            return $this->currentPage;
//        });
////        $this->resetPage();
//        $this->getITems();
////        $this->reload();
//    }
//
////    public function render()
////    {
////        return view('livewire.cms2.clients')
////            ->with(['items' => $this->items]);
////    }
//
//    public function render()
//    {
//        $this->getITems();
//        return view('livewire.cms2.staff')
//            ->with(['items' => $this->items]);
//    }
//}
