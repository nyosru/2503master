<?php

namespace App\Livewire\Cms2\Order;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLabelController;
use App\Http\Controllers\OrderPaymentTypeController;
use App\Http\Controllers\OrderProductTypeController;
use App\Models\Client;
use App\Models\LeedRecord;
use App\Models\Order;
use App\Models\OrderLabel;
use App\Models\OrderPaymentType;
use App\Models\OrderProductType;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Url;
use Livewire\Component;

use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;

class OrderCreate extends Component
{

    // Настройка слушателя события
    protected $listeners = [
        'addMetka' => 'metkaAdd'
//        // из формы симпл обновляем
//        'refreshLeedBoardComponent' => '$refresh',
//        // перетаскивание строк
//        'updateColumnOrder' => 'updateColumnOrder',
//        'loadColumns' => 'loadColumns',
////        'render' => 'render',
//
////        'loadColumns2' => 'loadColumns2',

    ];

    public $client_id;
    public $name;
    public $order_product_type_id;
// адрес монтажа
    public $adres;

    // дата монтажа // олд
    public $ready_dates;
    // нью
    public $montag_date;
    public $montag_date_comment;

    // срок изготовления
    public $production_time;
    // гарантийный срок
    public $guarantee_period;

    // дизайнер
    public $design;

    // метки // грузим для показа
    public $labels = [];
// метки нью
    public $metki = [];
    public $metki_show;

    public $virtual_order_id;

    // тип оплаты
    public $order_payment_type_id;

    // срочно
    public $urgently;

    public $order_form_data;
    public $form_data;
    public $form_id;
    public $form_type;
    public $manager_id;
    public $in_archive;
    public $last_log_id;
    public $price;
    public $price_without_decor;
    public $price_stone_countertop;

    public $last_roles_log_id;
    public $last_change_staff_id;
    public $last_change_ts;
    public $contract_id;


    public $group_id;
    public $brigade_id;

    public $types;
    public $type_payments;
    public $type_payments_month;
    public $forms_payment;


    public $discount;


    public $success_payment;
    public $comment_akcia;

    public $order_schedule;
    public $order_tfmf;
    public $summa_work;
    public $summa_install;
    public $summa_dop;
    public $summa_dop2;
    public $payment_dop;
    public $comment_dop;

    // генерируется
    public $virtual_service_id;

    public $service;
    public $usluga;
    public $summa_mebel;
    public $summa_build;
    public $summa_zamer;
    public $summa_dost;
    public $summa_gruz;
    public $summa_tech;
    public $summa_manager;

    public $clients;
    public $product_type;
    public $payment_type;


    #[Url]
    public $return_url; // Параметр для возврата

    public $return_url_array = ['client_created' => '']; // доп Параметр для возврата

    #[Url]
    public $return_leed = ''; // доп Параметр для возврата
    public $return_leed_name; // доп Параметр для возврата
    #[Url]
    public $client_to_order_id = ''; // если клиент выбран

    public $modal_view = false;
    public $modal_view1 = true;

    // для первого платежа
    public $pay_one;
    public $pay_one_payed;

    public function mount()
    {
        $this->clients = ClientController::get('mini');
        $this->product_type = OrderProductTypeController::get('mini');
        $this->payment_type = OrderPaymentTypeController::get('mini');
//        $this->labels = OrderLabelController::get('mini');
//        $this->labels = [];

        if (!empty($this->return_leed)) {
            $leed = LeedRecord::whereId($this->return_leed)->select('name')->first();
            if ($leed) {
                $this->return_leed_name = $leed->name;
            }
        }
//        if (!empty($client_to_order_id)) {
        if (!empty($this->client_to_order_id)) {
//            $this->client_to_order_id = $client_to_order_id;
//            $this->client_id = $client_to_order_id;
            $this->client_id = $this->client_to_order_id;
        }
    }


    protected function rules(): array
    {
        return [

            'client_id' => 'required',
            'name' => 'required|string',
            // адрес монтажа
            'adres' => 'nullable|string',

            // олд в бд
//            'ready_dates' => 'nullable|string',
            // нью в бд
            'montag_date' => 'nullable|date',
            'montag_date_comment' => 'nullable|string',

//{{--                    // срок изготовления--}}
            'production_time' => 'nullable|integer',
//{{--                    // гарантийный срок--}}
            'guarantee_period' => 'nullable|integer',

            // дизайнер
            'design' => 'nullable|string',

            'order_product_type_id' => 'nullable|integer|exists:order_product_types,id',
            'order_payment_type_id' => 'required|integer|exists:order_payment_types,id',
            'type_payments' => 'nullable',

            'pay_one' => 'nullable|integer',
            'pay_one_payed' => 'nullable|boolean',

            'price' => 'nullable|integer',
            'price_stone_countertop' => 'nullable|integer',
            'price_without_decor' => 'nullable|integer',

            'comment_akcia' => 'nullable|string',
            'discount' => 'nullable|integer|max:100',
            // срочно
            'urgently' => 'nullable|boolean',

//            'type_payments' => 'required|number',
//            'type_payments' => 'required|integer|exists:order_payment_types,id',
//            'order_product_type_id' => 'nullable|integer|exists:order_product_types,id',


//            'name_i' => 'required|string|max:255',
//            'name_f' => 'nullable|string|max:255',
//            'name_o' => 'nullable|string|max:255',
//            'phone' => 'required|string|max:20',
//            'extra_contacts' => 'nullable|string|max:255',
//            'address' => 'nullable|string|max:255',
//            'city' => 'nullable|string|max:255',
//            'street' => 'nullable|string|max:255',
//            'building' => 'nullable|string|max:255',
//            'building_part' => 'nullable|string|max:255',
//            'cvartira' => 'nullable|string|max:255',
//            'floor' => 'nullable|string|max:255',
//            'lift' => 'nullable|boolean',
//            'email' => 'nullable|email|max:255',
//            'comment' => 'nullable|string',
//            'physical_person' => 'nullable|string|in:yes,no', // Разрешаем только 'yes', 'no' или null
//            'status' => 'nullable|string|max:255',
//            'forma' => 'nullable|string|max:255',
//            'avatar' => 'nullable|string|max:255',
//            'passport' => 'nullable|string|max:255',
//            'seria_passport' => 'nullable|string|max:255',
//            'nomer_passport' => 'nullable|string|max:255',
//            'date_passport' => 'nullable|date',
//            'cod_passport' => 'nullable|string|max:255',
//            'ur_passport' => 'nullable|string|max:255',
//            'ur_name' => 'nullable|string|max:255',
//            'name_company' => 'nullable|string|max:255',
//            'active' => 'nullable|boolean',
        ];
    }

    /**
     * добавление метки если создали
     * @param $var
     * @return void
     */
    public function metkaAdd($var)
    {
        $this->metki[] = $var;
        $this->metki = array_unique($this->metki);
        $this->metkiRefresh();
    }

    public function metkaRemove($id)
    {
        $this->metki = array_filter($this->metki, function ($item) use ($id) {
            return $item !== $id;
        });
        $this->metkiRefresh();
    }

    public function metkiRefresh()
    {
//        $this->metki[] = $var;
        $this->metki_show = OrderLabel::whereIn('id', $this->metki)->orderBy('name')->get();
    }


    public function save()
    {
        $validatedData = $this->validate();

        try {
            $new_order = OrderController::addOrder($validatedData);
            session()->flash('success', 'Заказ успешно добавлен.');
        } catch (\Exception $e) {
            $new_order = $e->getMessage();
            session()->flash('error', 'Ошибка при добавлении заказа: ' . $e->getMessage());
        }

        // Перенаправляем на указанный URL
        $a = [];
        if (!empty($this->return_leed)) {
            $a['return_leed'] = $this->return_leed;
            $a['order_to_leed'] = $new_order->id;
        }

        return Redirect::route($this->return_url, $a);
    }

    public function render()
    {
        return view(
            'livewire.cms2.order.order-create',
            [
                'clients' => $this->clients,
                'product_type' => $this->product_type,
                'payment_type' => $this->payment_type,
                'labels' => $this->labels,
            ]
        );
    }
}
