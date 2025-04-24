<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\ClientSupplier;
use App\Models\Cms1\Clients;
use App\Models\LeedRecord;
use App\Models\OrderProductType;
use Livewire\Component;

class LeedRecordInfoForm extends Component
{
    public $board_id;
    public $leed;
    public $isEditing = true;

    public $name;
    public $phone;
//    public $company;
    public $fio;
    public $comment;
    public $budget;
    public $client_supplier_id;
    public $order_product_types_id;
    public $suppliers;
    public $types;


    public function mount(LeedRecord $leed)
    {
        $this->leed = $leed;
        $this->name = $this->leed->name;
        $this->phone = $this->leed->phone;
//        $this->company = $this->leed->company;
        $this->fio = $this->leed->fio;
        $this->comment = $this->leed->comment;
        $this->budget = $this->leed->budget;
        $this->client_supplier_id = $this->leed->client_supplier_id;
        $this->order_product_types_id = $this->leed->order_product_types_id;

        $this->suppliers = ClientSupplier::select('id','title')->get();
        $this->types = OrderProductType::select('id','name')->orderBy('order','asc')->get();

    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-record-info-form', [
            'leed' => $this->leed,
        ]);
    }

    protected $rules = [
        'name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:50',
//        'company' => 'nullable|string|max:255',
        'fio' => 'nullable|string|max:255',
        'budget' => 'nullable|integer',
        'comment' => 'nullable|string|max:1000',
        'client_supplier_id' => 'nullable|integer',
        'order_product_types_id' => 'nullable|integer',
    ];

    public function saveChanges()
    {
        $ee = $this->validate();
//dd($ee);
        $this->leed->name = $ee['name'];
        $this->leed->phone = $ee['phone'];
//        $this->leed->company = $ee['company'];
        $this->leed->fio = $ee['fio'];
        $this->leed->comment = $ee['comment'];
        $this->leed->budget = $ee['budget'];
        $this->leed->client_supplier_id  = $ee['client_supplier_id'];
        $this->leed->order_product_types_id  = $ee['order_product_types_id'];

        $this->leed->save();
        session()->flash('messageItemInfo', 'Сохранено');
        $this->redirectRoute('leed.item', $this->leed);
    }
}
