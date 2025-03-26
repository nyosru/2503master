<?php

namespace App\Livewire\Cms2\Order;

use App\Models\OrderPaymentType;
use Livewire\Component;

class PaymentTypeManager extends Component
{
    public $records; // Список записей
    public $name; // Поле для нового названия
    public $var_to_one;
    public $prepay;
    public $recordId; // ID записи для удаления

    protected $rules = [
        'name' => 'required|string|max:255',
        'var_to_one' => 'nullable|string', // Замените 'имя_существующего_поля' на имя поля, после которого нужно добавить новое поле
        'prepay' => 'nullable|integer|min:0|max:100'
    ];

    public function mount()
    {
        $this->loadRecords(); // Загружаем записи при инициализации компонента
    }

    public function loadRecords()
    {
        $this->records = OrderPaymentType::all(); // Получаем все записи из базы данных
    }

    public function addRecord()
    {
        $data = $this->validate();

        OrderPaymentType::create($data); // Создаем новую запись

        $this->reset('name','var_to_one','prepay'); // Сбрасываем поле ввода
        $this->loadRecords(); // Перезагружаем список записей

        session()->flash('message', 'Запись успешно добавлена!'); // Сообщение об успехе
    }

    public function deleteRecord($id)
    {
        OrderPaymentType::find($id)->delete(); // Удаляем запись по ID
        $this->loadRecords(); // Перезагружаем список записей

        session()->flash('message', 'Запись успешно удалена!'); // Сообщение об успехе
    }

    public function render()
    {
        return view('livewire.cms2.order.payment-type-manager');
    }
}
