<?php

namespace App\Livewire\Leed;

use App\Models\LeedMoneyMovement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MoneyForm extends Component
{
    public $leed_record_id;
    public $amount;
    public $comment;
    public $operation_date;

    protected $rules = [
        'amount' => 'required|numeric|between:-999999999.99,999999999.99',
        'comment' => 'nullable|string|max:500',
        'operation_date' => 'nullable|date'
    ];

    public function mount($leedRecordId)
    {
        $this->leed_record_id = $leedRecordId;
    }

    public function save()
    {
        $this->validate();

        LeedMoneyMovement::create([
            'leed_record_id' => $this->leed_record_id,
            'amount' => $this->amount,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
            'operation_date' => $this->operation_date
        ]);

        $this->reset(['amount', 'comment', 'operation_date']);
        $this->dispatch('payment-added');
//        session()->flash('moneyMessage', 'Платёж добавлен');
    }


    public function render()
    {
        return view('livewire.leed.money-form');
    }
}
