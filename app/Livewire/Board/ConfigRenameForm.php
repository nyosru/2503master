<?php

namespace App\Livewire\Board;

use App\Models\OrderRequestsRename;
use Livewire\Component;

class ConfigRenameForm extends Component
{
    public $board_id;
    public $order_requests_id;

    public $name;
    public $description;

    public function mount($board_id, $order_requests_id)
    {
        $this->board_id = $board_id;
        $this->order_requests_id = $order_requests_id;

        // Находим или создаём запись
        $rename = OrderRequestsRename::firstOrNew([
            'board_id' => $this->board_id,
            'order_requests_id' => $this->order_requests_id
        ]);

        $this->name = $rename->name ?? '';
        $this->description = $rename->description ?? '';
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        if( empty($this->name) ) {
            OrderRequestsRename::where(
                [
                    'board_id' => $this->board_id,
                    'order_requests_id' => $this->order_requests_id
                ]    )->delete();
            session()->flash('message', 'Настройки успешно сохранены! Включено оригинальное название.');
        }else {

            OrderRequestsRename::updateOrCreate(
                [
                    'board_id' => $this->board_id,
                    'order_requests_id' => $this->order_requests_id
                ],
                [
                    'name' => $this->name,
                    'description' => $this->description
                ]
            );
            session()->flash('message', 'Настройки успешно сохранены!');
        }

    }

    public function render()
    {
        return view('livewire.board.config-rename-form');
    }
}
