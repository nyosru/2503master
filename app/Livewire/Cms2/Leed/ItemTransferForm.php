<?php

namespace App\Livewire\Cms2\Leed;

use App\Http\Controllers\ColumnController;
use App\Http\Controllers\RecordController;
use App\Models\BoardUser;
use App\Models\LeadTransfer;
use App\Models\LeadUserAssignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ItemTransferForm extends Component
{
    public $lead; //  лида
    public $lead_id;
    public $sendToUser; // ID пользователя, которому передаем

    public function transferLead()
    {
        try {

            $this->lead_id = $this->lead->id;

            $this->validate([
                'lead_id' => 'required|exists:leed_records,id',
                'sendToUser' => 'required|exists:users,id', // Валидация: пользователь должен быть выбран и существовать
            ]);

            RecordController::sendRecordToColumnUser($this->lead, $this->sendToUser);

            session()->flash(
                'transferRecordMessage',
                'Передан!'
            );

        } catch (\Exception $e) {
            session()->flash('transferRecordError', "Ошибка при создании передачи лида: " . $e->getMessage() );
        }

        // Эмитируем событие для обновления других компонентов, если необходимо
        $this->dispatch('loadColumns');

    }

    public function render()
    {
        $user_id = Auth::id();

        $users = User::where('id', '!=', $user_id)
            ->with(
                'roles',
            )
            ->get();
        return view('livewire.cms2.leed.item-transfer-form', [
            'users' => $users
        ]);
    }

}
