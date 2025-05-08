<?php

namespace App\Livewire\File;

use App\Models\FileUpload;
use Livewire\Component;

class Manager extends Component
{
    public $leed;
    public $board_id;
    public $files;

    public function mount()
    {
    }

    public function load()
    {
        $this->files = FileUpload::whereLeedRecordId($this->leed->id)
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        $this->load();
        return view('livewire.file.manager');
    }
}
