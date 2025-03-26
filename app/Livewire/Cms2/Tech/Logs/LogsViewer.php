<?php

namespace App\Livewire\Cms2\Tech\Logs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Logs2;
use App\Models\User;
use App\Models\Order;
use App\Models\LeedRecord;

class LogsViewer extends Component
{
    use WithPagination;


    public $filters = [
        'user_id' => null,
        'order_id' => null,
        'leed_record_id' => null,
    ];
    protected $queryString = ['filters'];
    public $user_id;
    public $order_id;
    public $leed_record_id;

    public function updating($property)
    {
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage(); // Сброс на первую страницу при изменении фильтров
    }

    public function render()
    {
        $query = Logs2::query();

        if (!empty($this->filters['user_id'])) {
            $query->where('user_id', $this->filters['user_id']);
        }

        if (!empty($this->filters['order_id'])) {
            $query->where('order_id', $this->filters['order_id']);
        }

        if (!empty($this->filters['leed_record_id'])) {
            $query->where('leed_record_id', $this->filters['leed_record_id']);
        }

        $logs = $query->with(['user' => function ($query) {
            $query->withTrashed()->select('id', 'name','deleted_at');
        }])->orderBy('created_at', 'desc')->paginate(10);


        // Получаем заказы, связанные с выбранным пользователем
        $orders = Order::select('id','name')->get();
//        $orders = Order::when($this->filters['user_id'], function ($query, $user_id) {
//            return $query->where('user_id', $user_id);
//        })->get();

        // Получаем лиды, связанные с выбранным пользователем
        $leedRecords = LeedRecord::select('id','name')->when($this->filters['user_id'], function ($query, $user_id) {
            return $query->where('user_id', $user_id);
        })->get();


        return view('livewire.cms2.tech.logs.logs-viewer', [
            'logs' => $logs,
            'users' => User::all(),
            'orders' => $orders,
            'leedRecords' => $leedRecords,
        ]);
    }
}
