<?php

namespace App\Livewire\Cms2\Order;

use App\Models\OrderPaymentType;
use App\Models\OrderProductType;
use Livewire\Component;

class AddFormSimple extends Component
{

    public $client_id;
    public $name;
    public $montag_date;
    public $montag_adres;
    public $price; // Общая стоимость
    public $amount_tech; // Стоимость техники
//    public $price_without_decor; // Стоимость техники
    public $amount_stone; // Стоимость техники
//    public $price_stone_countertop; // Стоимость камня



    public $order_form_data;
    public $form_data;
    public $form_id;
    public $form_type;
    public $manager_id;
    public $in_archive;
    public $add_ts;
    public $last_log_id;
    public $ready_dates;
    //  {% if data.page == "services" %} Дата готовности {%else%}Дата монтажа{%endif%}
    public $last_roles_log_id;
    public $last_change_staff_id;
    public $last_change_ts;
    public $contract_id;
    public $urgently;
    public $group_id;
    public $brigade_id;
    public $types;
    public $type_payments;
    public $type_payments_month;
    public $forms_payment;
    public $discount;
    public $adres; // Адрес монтажа
    public $labels;
    public $design;
    public $success_payment;
    public $comment_akcia;
    public $production_time;
    public $guarantee_period;
    public $order_schedule;
    public $order_tfmf;
    public $summa_work;
    public $summa_install;
    public $summa_dop; // Доп заказ сумма мебели
    public $summa_dop2; // Доп заказ стоимость камня
    public $payment_dop; // Способ оплаты
    public $comment_dop; // Дополнительный комментарий
    public $virtual_order_id;
    public $virtual_service_id;
    public $service; // Услуга
    public $usluga; // Описание услуги
    public $summa_mebel; // Сумма мебели
    public $summa_build; // Сумма строительства
    public $summa_zamer; // Сумма замера
    public $summa_dost; // Сумма доставки
    public $summa_gruz; // Сумма груза
    public $summa_tech; // Сумма технических работ
    public $summa_manager; // Сумма менеджера

//    public $order_name;
//    public $order_date_montag;
//    public $order_adres_montag;
//    public $order_amount;
//    public $order_amount_tech;
//    public $order_amount_stone;
//    public $order_type_item;
//    public $order_type_pay;
//    public $order_amount_predoplata;
//    public $order_sroc_gotov;
//    public $order_sroc_garantiya;
//    public $order_akciya_for_client;
//    public $order_akciya_comment;
//    public $order_designer;
    public $typeDispatch = "";

    public $payment_type;
    public $product_type;

    public function mount(){
        $this->payment_type = OrderPaymentType::orderBy('order')->get();
        $this->product_type = OrderProductType::orderBy('order','asc')->get();
    }

    public function updated($propertyName)
    {
        if ($this->typeDispatch == 'creat_leed_mini') {
            $this->dispatch('orderInputUpdated', ['name' => $propertyName, 'value' => $this->$propertyName]);
        }
    }

    public function render()
    {
        return view('livewire.cms2.order.add-form-simple');
    }
}
