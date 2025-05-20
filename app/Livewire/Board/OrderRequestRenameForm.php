<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\OrderRequest;
use App\Models\OrderRequestRename;
use App\Models\OrderRequestsRename;
use Livewire\Component;

class OrderRequestRenameForm extends Component
{

    public $board_id;
    public $boards;
    public $order_request_id;

    // Массив для хранения пользовательских названий: ['field_name' => 'custom_name']
    public $fields = [];

    // Список оригинальных полей из OrderRequest
    public $orderRequestFields = [];
    public $existingRenames = [];

    public function mount(
//        $board_id
//        , $order_request_id
    )
    {
        $this->boards = Board::all();
//        $this->board_id = $board_id;
//        $this->order_request_id = $order_request_id;

        // Получаем экземпляр OrderRequest
//        $orderRequest = OrderRequest::findOrFail($order_request_id);

        // Предположим, что OrderRequest - это модель с атрибутами, которые нужно переименовать
        // Получаем список ключей (названий полей), например:
//        $this->orderRequestFields = array_keys($orderRequest->getAttributes());

    }

    public function load()
    {
        // Загружаем существующие переименования для данной доски и OrderRequest
        $this->existingRenames = OrderRequestsRename::where('board_id', $this->board_id)
//            ->where('order_request_id', $order_request_id)
            ->get()
            ->keyBy('field_name');

        // Заполняем $fields значениями из базы или пустыми строками
//        foreach ($this->orderRequestFields as $field) {
//            $this->fields[$field] = $existingRenames->has($field) ? $existingRenames[$field]->custom_name : '';
//        }
    }

    public function save()
    {
        foreach ($this->fields as $fieldName => $customName) {
            // Если пользователь ввёл новое имя, сохраняем или обновляем запись
            if (trim($customName) !== '') {
                OrderRequestsRename::updateOrCreate(
                    [
                        'board_id' => $this->board_id,
                        'order_request_id' => $this->order_request_id,
                        'field_name' => $fieldName,
                    ],
                    [
                        'custom_name' => $customName,
                    ]
                );
            } else {
                // Если поле пустое, удаляем существующую запись (если есть)
                OrderRequestsRename::where('board_id', $this->board_id)
                    ->where('order_request_id', $this->order_request_id)
                    ->where('field_name', $fieldName)
                    ->delete();
            }
        }

        session()->flash('message', 'Настройки сохранены успешно.');
    }


    public function render()
    {
        if( !empty($this->board_id) ){
            $this->load();
        }

        return view('livewire.board.order-request-rename-form');
    }
}
