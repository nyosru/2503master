<?php

namespace App\Livewire\Board\Config;

use App\Models\Board;
use Livewire\Attributes\Url;
use Livewire\Component;

class IndexComponent extends Component
{

    public $board;
    #[Url]
    public $activeTab;

    public $buttons = [
        'base' => ['name' => 'Базовые настройки', 'template' => 'board.config.user-settings'],
        'polya' => ['name' => 'Настройки полей', 'template' => 'board.config.polya-component'],
        'users' => ['name' => 'users', 'template' => 'board.config.user-settings'],
        'macros' => ['name' => 'macros', 'template' => 'board.config.macros-component'],
        'board.field-settings' => ['name' => 'field', 'template' => 'board.field-settings'],
    ];


    public function mount(Board $board)
    {
        $this->board = $board;
    }

    public function render()
    {
        return view('livewire.board.config.index-component');
    }
}
