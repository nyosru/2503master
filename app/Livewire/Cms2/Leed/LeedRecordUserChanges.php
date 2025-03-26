<?php

namespace App\Livewire\Cms2\Leed;

use Livewire\Component;

class LeedRecordUserChanges extends Component
{
    public $leed;
    public function render()
    {
        return view('livewire.cms2.leed.leed-record-user-changes');
    }
}
