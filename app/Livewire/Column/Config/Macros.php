<?php

namespace App\Livewire\Column\Config;

use App\Http\Controllers\Services\MacrosController;
use App\Models\LeedColumn;
use Livewire\Component;

class Macros extends Component
{

    public $macroses;
    public $column;

    public function mount(LeedColumn $column){

        $this->column = $column;

        $m = new MacrosController();
        $this->macroses = $m->get( $column->id );

    }

    public function render()
    {
        return view('livewire.column.config.macros');
    }

}
