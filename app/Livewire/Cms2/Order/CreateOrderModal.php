<?php

namespace App\Livewire\Cms2\Order;

use App\Models\Client;
use Livewire\Component;

class CreateOrderModal extends Component
{
    public bool $open = false; // Состояние модального окна
    public $client_id; // ID выбранного клиента
    public $record_id;
    public $client_to_order_id;
    public $modal_view;
    public $return_url;

    public function mount()
    {
//        $this->clients = Client::all();
    }

//    public $clients = [];
//
//    // Правила валидации
//    protected $rules = [
//        'client_id' => 'required|exists:clients,id', // Проверяем, что client_id существует в таблице clients
//    ];
//
//    // Метод для создания заказа
//    public function createOrder()
//    {
//        $this->validate();
//
//        // Логика создания заказа
//        // ...
//
//        session()->flash('message', 'Заказ успешно создан!');
//
//        $this->closeModal();
//    }

//    // Метод для открытия модального окна
    public function openModal()
    {
        $this->open = true;
    }
//
//    // Метод для закрытия модального окна
    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation(); // Сброс ошибок валидации
    }


    public function render()
    {
        return view('livewire.cms2.order.create-order-modal');
    }
}
