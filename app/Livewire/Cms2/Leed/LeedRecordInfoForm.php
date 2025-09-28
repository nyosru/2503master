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

    // Все поля
    public $name, $phone, $company, $fio, $comment, $budget;
    public $client_supplier_id, $order_product_types_id;
    public $telegram, $whatsapp, $fio2, $phone2, $cooperativ, $price, $date_start, $base_number, $link;
    public $platform, $customer, $payment_due_date, $submit_before;
    public $pay_day_every_year, $pay_day_every_month, $email, $obj_tender;
    public $zakazchick, $post_day_ot, $post_day_do, $mesto_dostavki;
    public $number1, $number2, $number3, $number4, $number5, $number6;
    public $date1, $date2, $date3, $date4, $dt1, $dt2, $dt3;
    public $string1, $string2, $string3, $string4;

    public $suppliers, $types;

    public function mount(LeedRecord $leed, $isEditing = true)
    {
        $this->leed = $leed;
        $this->isEditing = $isEditing;

        $this->fill($this->leed);

        $this->suppliers = ClientSupplier::select('id', 'title')->get();
        $this->types = OrderProductType::select('id', 'name')->orderBy('order')->get();
    }

    protected function rules()
    {
        return BoardController::getRules($this->board_id);
    }

    public function saveChanges()
    {
        $validated = $this->validate();
        $this->leed->fill($validated)->save();

        return redirect()->route('board.leed.item', [
            'board_id' => $this->board_id,
            'leed_id' => $this->leed->id
        ])->with('messageItemInfo', 'Сохранено');
    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-record-info-form', [
            'leed' => $this->leed,
        ]);
    }
}
