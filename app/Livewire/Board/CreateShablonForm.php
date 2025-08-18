<?php

namespace App\Livewire\Board;

use App\Models\BoardTemplate;
use Livewire\Component;

class CreateShablonForm extends Component
{

    public $shablons;

    public function mount()
    {
        $this->shablons = BoardTemplate::with(['columns', 'positions'])->get();
    }

    public function createBoardFromShablon( $id )
    {
        $template = BoardTemplate::where('id',$id)->with(['columns', 'positions'])->firstOrFail();
//        dd($template->toArray());

    }

    public function render()
    {
        return view('livewire.board.create-shablon-form');
    }
}
