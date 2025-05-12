<?php

namespace App\Livewire\Leed;

use App\Http\Controllers\LeedMoneyController;
use App\Models\LeedMoneyMovement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MoneyListComponent extends Component
{
    use WithPagination;

    public $leed_record_id;

//    protected $listeners = ['payment-added' => 'render'];
//    protected $listeners = ['payment-added' => '$refresh'];
    protected $listeners = ['payment-added' => 'payAdded'];

    public $showForm = false;

    public function payAdded()
    {
        session()->flash('moneyMessage', 'Платёж добавлен');
        $this->showForm = false;
    }

    public function showCreateForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function mount($leedRecordId)
    {
        $this->leed_record_id = $leedRecordId;
    }

    public function delete($id)
    {
        LeedMoneyMovement::find($id)->delete();
        session()->flash('moneyMessage', 'Запись удалена');
    }

    public function render()
    {
        $summa = LeedMoneyController::getTotalAmount($this->leed_record_id);
        $payments = LeedMoneyMovement::where('leed_record_id', $this->leed_record_id);
        $user = Auth::user();
        if ($user->hasPermissionTo('р.Деньги / видеть удалённые записи')) {
            $payments = $payments->withTrashed();
        }

        $payments = $payments->latest()->paginate(10);


        return view('livewire.leed.money-list-component', compact('payments', 'summa'));
    }
}
