<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeadUserAssignment;
use App\Models\LeedRecord;
use App\Models\LeedRecordOrder;
use App\Models\User;
use Livewire\Component;

class ItemOrderCreate extends Component
{

    public $users;
    public $text = '';
//    public $notificateDate = '';
//    public $notificateTime = '10:00';
    public $notificateDateTime = '';

    public $user_worker_id;
    public $leed_record_id;

    protected $rules = [
        'text' => 'required|string|max:500',
        'user_worker_id' => 'nullable|exists:clients,id',
        'notificateDateTime' => 'nullable|date',
    ];

    public function mount($leed_record_id)
    {
        $this->leed_record_id = $leed_record_id;
    }

    public function add()
    {
        $this->validate();

        $in = [
            'text' => $this->text,
            'user_id' => auth()->id(),
            'leed_record_id' => $this->leed_record_id,
            'user_worker_id' => $this->user_worker_id,
        ];
        if (!empty($this->notificateDateTime)) {
            $in['reminder_at'] = $this->notificateDateTime;
        }

        $new_leed_order = LeedRecordOrder::create($in);

        if (!empty($this->user_worker_id)) {
            LeadUserAssignment::create([
                'lead_id' => $this->leed_record_id,
                'user_id' => $this->user_worker_id,
            ]);

        }

        session()->flash('msgLeedOrder', 'Успешно добавлена!');

        $this->reset('text', 'notificateDateTime', 'user_worker_id');
        return $this->redirectRoute('leed.item', ['id' => $this->leed_record_id]);
    }


    public function render()
    {
        $this->users = User::with('roles')->get();
        return view('livewire.cms2.leed.item-order-create');
    }
}
