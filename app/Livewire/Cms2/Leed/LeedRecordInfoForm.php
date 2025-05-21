<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\BoardController;
use App\Models\ClientSupplier;
use App\Models\Cms1\Clients;
use App\Models\LeedRecord;
use App\Models\OrderProductType;
use App\Models\OrderRequestsRename;
use Livewire\Component;

class LeedRecordInfoForm extends Component
{
    public $board_id;
    public $leed;
    public $isEditing = true;
    public $polyas = [];

    public $name;
    public $phone;
    public $company;
    public $fio;
    public $comment;
    public $budget;
    public $client_supplier_id;
    public $order_product_types_id;
    public $suppliers;
    public $types;

    public $telegram;
    public $whatsapp;
    public $fio2;
    public $phone2;
    public $cooperativ;
    public $price;
    public $date_start;
    public $base_number;
    public $link;
//    public $is_web_link;
//    public $url;


    public $platform;

    public $customer;
    public $payment_due_date;
    public $submit_before;

    public $pay_day_every_year;
    public $pay_day_every_month;
    public $email;
    public $obj_tender;

    public $zakazchick;
    public $post_day_ot;
    public $post_day_do;
    public $mesto_dostavki;

public $number1; public $number2; public $number3; public $number4; public $number5; public $number6;
public $date1; public $date2; public $date3; public $date4;
public $dt1; public $dt2; public $dt3;
public $string1; public $string2; public $string3; public $string4;

    public function mount(LeedRecord $leed)
    {

        //        dd($leed->toArray());
        $this->leed = $leed;

//        $this->link = $leed->link;

        // Автоматическое заполнение свойств из модели
        $this->fill($leed->toArray());

//        $this->polyas = OrderRequestsRename::where('board_id', $this->board_id)
////            ->pluck('rename', 'name')->toArray()
//            ->get()
//        ;

        $this->suppliers = ClientSupplier::select('id', 'title')->get();
        $this->types = OrderProductType::select('id', 'name')->orderBy('order', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-record-info-form', [
            'leed' => $this->leed,
        ]);
    }

    public function saveChanges()
    {

        $rules = BoardController::getRules();
        $ee = $this->validate($rules);

        foreach ($ee as $k => $v) {
            if ($this->leed->{$k} != $v) {
                $this->leed->{$k} = $v;
            }
        }

        $this->leed->save();
        session()->flash('messageItemInfo', 'Сохранено');

        //        $this->redirectRoute('leed.item', [ 'board_id' => $this->board_id, 'id' => $this->leed->id);
        return redirect()->route('leed.item', ['board_id' => $this->board_id, 'id' => $this->leed->id]);

    }

}
