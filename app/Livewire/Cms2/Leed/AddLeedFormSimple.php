<?php

namespace App\Livewire\Cms2\Leed;


use App\Http\Controllers\LeedChangeUserController;
use App\Models\ClientSupplier;
use App\Models\Client;
use App\Models\Order;
use App\Models\LeadUserAssignment;
use App\Models\LeedColumn;
use App\Models\LeedRecord;
use App\Models\OrderProductType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Livewire;
use Illuminate\Support\Facades\Log;

class AddLeedFormSimple extends Component
{
    public $column;
    public $isFormVisible = false; // Состояние для отображения/скрытия формы
    public $name, $phone, $telegram, $whatsapp, $fio, $comment; // Переменные для формы
    public $client_supplier_id; // Переменная для ID поставщика
    public $client_id;
    public $order_product_types_id;
    public $budget;
//    public $board_id;

    public $order = [];

    protected $listeners = ['orderInputUpdated' => 'orderChildInputUpdated'];

    /**
     * заливаем переменные от формы создания заказа
     * @param $val
     * @return void
     */
    public function orderChildInputUpdated($val)
    {
        $this->order[$val['name']] = $val['value'];
        Log::info('order',$this->order);
    }


    // Метод для переключения видимости формы
    public function toggleForm()
    {
        $this->isFormVisible = !$this->isFormVisible;
    }

    // Метод для добавления записи
    public function addLeedRecordOrder()
    {
//        dd(__LINE__);
        try {
            $e = $this->validate([
                'order.name' => 'nullable|string|max:255',
                'order.montag_date' => 'nullable|date',
                'order.montag_adres' => 'nullable|string|max:255',
                'order.amount_tech' => 'nullable|integer',
                'order.amount_stone' => 'nullable|integer',
//                'order.order_product_types_id' => 'nullable|exists:order_product_types,id',
//                'phone' => 'nullable|string|max:20',
//                'telegram' => 'nullable|string|max:255',
//                'whatsapp' => 'nullable|string|max:255',
//                'company' => 'nullable|string|max:255',
//                'comment' => 'nullable|string|max:1000',
//                'client_supplier_id' => 'nullable|exists:client_suppliers,id', // Валидация для поля client_supplier_id
            ]);
            dd( $e );
            Order::all();
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function addLeedRecord()
    {
//        $this->addLeedRecordOrder($this->order);

        $this->validate([
            'name' => 'nullable|string|max:255',
            'fio' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
//            'telegram' => 'nullable|string|max:255',
//            'whatsapp' => 'nullable|string|max:255',
//            'company' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:1000',
            'client_supplier_id' => 'nullable|exists:client_suppliers,id', // Валидация для поля client_supplier_id
            'order_product_types_id' => 'nullable|exists:order_product_types,id',
        ]);

        $user_id = Auth::id();

        // Создание новой записи в базе данных
        $leadRecord = LeedRecord::create([
            'name' => $this->name,
            'phone' => $this->phone,
//            'company' => $this->company,
            'fio' => $this->fio,
            'comment' => $this->comment,
            'leed_column_id' => $this->column->id,
            // источник
            'client_supplier_id' => $this->client_supplier_id,
            'budget' => $this->budget,
            'order_product_types_id' => $this->order_product_types_id,
            'user_id' => $user_id,
        ]);

        $us = User::find($user_id);
//        dd([$us,$this->leed->toArray()]);
        LeedChangeUserController::changeUser($leadRecord, $us);

        // Добавление записи в LeadUserAssignment
        LeadUserAssignment::create([
            'lead_id' => $leadRecord->id,
            'user_id' => $user_id,
        ]);

        // Очистка полей после добавления
        $this->reset(['name', 'phone', 'telegram', 'whatsapp', 'fio', 'comment', 'client_supplier_id']);


        // Закрыть форму после добавления
        $this->isFormVisible = false;

        // Сообщение об успешном добавлении
//        session()->flash('message', 'Новый лид успешно добавлен!');

        // Эмитируем событие на другой компонент
//        $this->dispatch('refreshLeedBoardComponent');
        return $this->redirectRoute('leed',['board_id'=>$this->column->board_id]);
    }

    public function render()
    {
        // Получаем список поставщиков из модели ClientSupplier
        $suppliers = ClientSupplier::all();
        $clients = Client::orderBy('name_f')->get();
        $types = OrderProductType::orderBy('order','asc')->get();

        return view('livewire.cms2.leed.add-leed-form-simple', [
            'suppliers' => $suppliers,
            'clients' => $clients,
            'types' => $types,
        ]);
    }
}
