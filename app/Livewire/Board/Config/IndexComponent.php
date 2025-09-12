<?php

namespace App\Livewire\Board\Config;

use App\Models\Board;
use Livewire\Attributes\Url;
use Livewire\Component;

class IndexComponent extends Component
{

    public Board $board;

    #[Url]
    public $activeTab;

    public $buttons = [
        'base' => ['name' => 'Базовые настройки', 'template' => 'board.config.user-settings'],
//        'users' => ['name' => 'users', 'template' => 'board.config.user-settings'],

        'board.field-settings' => ['name' => 'Настройки полей', 'template' => 'board.field-settings'],
//        'polya' => ['name' => 'Настройки полей', 'template' => 'board.config.polya-component'],

//        'macros' => ['name' => 'Автодейсвтия (макросы)', 'template' => 'board.config.macros-component'],

    ];


    public function mount( )
    {
        if( !empty(request()->board_id)) {
            $this->board = Board::find(request()->board_id);
        }
    }

    public function render()
    {
        return view('livewire.board.config.index-component');
    }
}
