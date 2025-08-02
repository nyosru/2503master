<?php

namespace App\Livewire\Macros;

use App\Models\Macros;
use Livewire\Component;

class Listing extends Component
{

    public $board_id;
    public $macroses;

    public function mount()
    {
        $this->loadMacroses();
    }

    public function loadMacroses()
    {

        $query = Macros::with(['macroType', 'columns' => function ($q) {
            $q->where('board_id', $this->board_id);
        }]);

//        // Если выбраны колонки — фильтруем макросы по ним
        if (!empty($this->board_id)) {
            $query->whereHas('columns', function ($q) {
                $q->where('board_id', $this->board_id);
            });
        }

        $this->macroses = $query->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.macros.listing');
    }
}
