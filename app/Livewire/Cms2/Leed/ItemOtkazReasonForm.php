<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecord;
use Livewire\Component;

class ItemOtkazReasonForm extends Component
{
    public $recordId;
    public $reason;

    public function sendReason()
    {
        // Валидация данных
        $this->validate([
            'reason' => 'required|string|max:1000',
        ]);

        // Найти запись и сохранить причину отказа
        $leed = LeedRecord::find($this->recordId); // Предположим, что используется модель LeedRecord

        try {
//        if ($record) {
            $leed->otkaz_reason = $this->reason;
            $leed->save();

            // Сброс данных
            $this->reason = '';

            // Сообщение об успехе
            session()->flash('messageOtkazReason', 'Причина отказа сохранена успешно.');
//        } else {
// Вызов функции `loadRefresh` у родителя
//            $this->emitUp('loadColumns'); // Вызвать событие на родительском компоненте
//            $this->emitUp('refreshLeedBoardComponent'); // Вызвать событие на родительском компоненте

//            $this->emitUp('render'); // Вызвать событие на родительском компоненте
//            $this->emitUp('refreshLeedBoardComponent'); // Вызвать событие на родительском компоненте
//            $this->emitUp('loadColumns2'); // Вызвать событие на родительском компоненте

            // Вызов события в родительском компоненте
            $this->dispatch('loadColumns');

        } catch
        (\Exception $ex) {
            session()->flash('errorOtkazReason', 'Ошибка пи добавлении причины ухода в отказ. '.$ex->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.cms2.leed.item-otkaz-reason-form');
    }
}
