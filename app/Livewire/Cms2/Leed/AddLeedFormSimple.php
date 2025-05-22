<?php

namespace App\Livewire\Cms2\Leed;


use App\Http\Controllers\BoardController;
use App\Http\Controllers\LeedChangeUserController;
use App\Models\BoardFieldSetting;
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
    public $company; // Переменные для формы
    public $client_supplier_id; // Переменная для ID поставщика

    public $fio2;
    public $phone2;
    public $cooperativ;
    public $price;
    public $date_start;


    public $client_id;
    public $order_product_types_id;
    public $budget;
//    public $board_id;
//[0] => name
    public $platform;
    public $base_number;
//[3] => budget
    public $link;
    public $customer;

    public $submit_before;
    public $payment_due_date;

    public $pay_day_every_year;
    public $pay_day_every_month;


    public $email;
    public $obj_tender;
    public $zakazchick;
    public $post_day_ot;
    public $post_day_do;
    public $mesto_dostavki;

    public $order = [];

//    public $fio2;
//    public $phone2;
//    public $date_start;
//    public $price;
//    public $pay_day_every_year;
//    public $pay_day_every_month;
//    public $email;
//    public $obj_tender;
//    public $zakazchick;
//    public $post_day_ot;
//    public $post_day_do;
//    public $mesto_dostavki;

    public $number1; public $number2; public $number3; public $number4; public $number5; public $number6;
    public $date1; public $date2; public $date3; public $date4;
    public $dt1; public $dt2; public $dt3;
    public $string1; public $string2; public $string3; public $string4;


    protected $listeners = ['orderInputUpdated' => 'orderChildInputUpdated'];


    /**
     * заливаем переменные от формы создания заказа
     * @param $val
     * @return void
     */
    public function orderChildInputUpdated($val)
    {
        $this->order[$val['name']] = $val['value'];
        Log::info('order', $this->order);
    }


    // Метод для переключения видимости формы
    public function toggleForm()
    {
        $this->isFormVisible = !$this->isFormVisible;
    }

// Вспомогательный метод для получения отсортированных полей
    private function getAllowedFields()
    {
        $boardId = $this->column->board_id;
        $fields = BoardFieldSetting::where('board_id', $boardId)
            ->where('is_enabled', true)
            ->with([
                'orderRequest' => function ($query) {
                    $query->with('rename');
                }
            ])

//@if( !empty($field->orderRequest->rename->name) )

            ->orderBy('sort_order', 'desc')
            ->get()
//            ->pluck('field_name') // Возвращаем только имена полей
//            ->toArray()
        ;

        return $fields; // Массив разрешенных имен полей
    }


    public function addLeedRecord()
    {

        $rules = BoardController::getRules();
        $this->validate($rules);

        $user_id = Auth::id();

        $in = [
            'leed_column_id' => $this->column->id,
            'user_id' => $user_id,
        ];

        $polya = $this->getAllowedFields();
//        dd($polya);

        foreach ($polya as $v) {
            $in[$v['field_name']] = $this->{$v['field_name']}; //dd($this->$v
        }

//        dd($in);

        // Создание новой записи в базе данных
        $leadRecord = LeedRecord::create($in);

        $us = User::find($user_id);
        LeedChangeUserController::changeUser($leadRecord, $us);

        // Добавление записи в LeadUserAssignment
        LeadUserAssignment::create([
            'lead_id' => $leadRecord->id,
            'user_id' => $user_id,
        ]);

        // Очистка полей после добавления
        if ($in['leed_column_id']) {
            unset($in['leed_column_id']);
        }
        if ($in['user_id']) {
            unset($in['user_id']);
        }

        $this->reset(array_keys($in));

        // Закрыть форму после добавления
        $this->isFormVisible = false;

        // Сообщение об успешном добавлении
//        session()->flash('message', 'Новый лид успешно добавлен!');

        // Эмитируем событие на другой компонент
//        $this->dispatch('refreshLeedBoardComponent');

        return $this->redirectRoute('leed', ['board_id' => $this->column->board_id]);
    }

    public function render()
    {
        // Получаем список поставщиков из модели ClientSupplier
        $suppliers = ClientSupplier::all();
        $clients = Client::orderBy('name_f')->get();
        $types = OrderProductType::orderBy('order', 'asc')->get();

        // 1. Получаем разрешенные поля из конфига
        $allowedFields = $this->getAllowedFields();

        return view('livewire.cms2.leed.add-leed-form-simple', [
            'suppliers' => $suppliers,
            'clients' => $clients,
            'types' => $types,
            'allowedFields' => $allowedFields, // Передаем в шаблон
        ]);
    }

}
