<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecordOrder;
use App\Models\LeedRecordOrderTransfer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ItemOrderItem extends Component
{

    public $i;
    public $formCloseShow = false;
    public $newStatus = '';
    public $msgClose = '';
    public $user_id;
    public $workerComment;
    public $isEditing = true;
    public $thisAutor;
    public $newReminderAt;
    public $budget;
    public $msg;

    public function mount(LeedRecordOrder $i)
    {
        $this->i = $i;
        $this->user_id = Auth::id();
        $this->thisAutor = $i->user->id == Auth::id();
    }

    /**
     * сохранение коментария от работника
     * @return void
     */
    public function submitWorkerComment($id)
    {
        $this->i->update([
            'worker_comment' => $this->workerComment,
            'worker_job_status' => true,
            'worker_comment_at' => now()
        ]);
        $this->i->save();
        session()->flash('msgLeedOrderWorker', 'Задача готова, отправили сообщение!');
    }

    public function setStatus($new_status = '')
    {
        if (!empty($new_status)) {
            $this->newStatus = $new_status;
        }

        $this->i->status = $this->newStatus;
        $this->i->close_comment = $this->msgClose;
        $this->i->close_at = now();
        $this->i->save();
        return $this->redirectRoute('leed.item',['id'=>$this->i->leed_record_id]);
    }

    public function setNewAlert()
    {
        $this->i->reminder_at = $this->newReminderAt;
        $this->i->save();

        LeedRecordOrderTransfer::create([
            'leed_record_order_id' => $this->i->id,
            'user_id' => Auth::id(),
            'msg' => $this->msg,
            'transferred_at' => $this->newReminderAt
        ]);
        return $this->redirectRoute('leed.item',['id'=>$this->i->leedRecord->id]);
    }

    public function render()
    {
        return view('livewire.cms2.leed.item-order-item');
    }
}
