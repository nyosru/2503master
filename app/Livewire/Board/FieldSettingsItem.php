<?php

namespace App\Livewire\Board;

use App\Models\BoardFieldSetting;
use Livewire\Component;

class FieldSettingsItem extends Component
{
    public $field;

    public $is_enabled;
    public $show_on_start;
    public $in_telega_msg;
    public $sort_order;
    public $board_id;

    public function mount($field, $board_id)
    {
        $this->field = $field;
//        dd($this->field);

        $this->is_enabled = (bool)empty($this->field['is_enabled']) ? false : true;
        $this->show_on_start = (bool)empty($this->field['show_on_start']) ? false : true;
        $this->in_telega_msg = (bool)empty($this->field['in_telega_msg']) ? false : true;
        $this->sort_order = $this->field['sort_order'] ?? 0;

//        $this->is_enabled = (bool) $this->field['is_enabled'] ?? false;
//
////        if( !empty($this->is_enabled) )
////            dd($this->field);
//
//        $this->show_on_start = (bool) $this->field['show_on_start'] ?? false;
//        $this->boardId = $board_id;
    }

    public function updated($property)
    {
        BoardFieldSetting::updateOrCreate(
            [
                'board_id' => $this->board_id,
                'field_name' => $this->field['pole'],
            ],
            [
                'is_enabled' => $this->is_enabled,
                'show_on_start' => $this->show_on_start,
                'in_telega_msg' => $this->in_telega_msg,
                'sort_order' => $this->sort_order ?? 0,
            ]
        );
        // Можно добавить уведомление или emit событие
    }

    public function render()
    {
        return view('livewire.board.field-settings-item');
    }
}
