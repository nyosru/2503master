<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecord;
use Livewire\Component;

class Item extends Component
{
    public $id;
    public $leed;
    public $showTab = 'order'; // order|comment|notificate
    public $overflowHidden;

    public $queryString = [
        'showTab' => ['except' => 'order'], // 'except' - значение по умолчанию (не записывать в URL)
    ];

    public function changeShowTab($showMeTab)
    {
        $this->showTab = $showMeTab;
    }

    public function mount($showTab = '')
    {

        if (!empty($showTab)) {
            dd($showTab);
            $this->changeShowTab($showTab);
        }

        $this->leed = LeedRecord::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'column' => function ($query) {
                $query->with([
                    'board' => function ($query) {
                        $query->select('id','name');
                    }
                ]);
            },
            'supplier' =>  function ($query) {
                $query->withTrashed();
            },
            'userChanges' =>  function ($query) {
                $query->orderBy('created_at', 'desc');
                $query->with(['newUser' => function ($query) {
                    $query->withTrashed();
                    $query->with(['roles' => function ($query) {}]);
//                    $query->with(['staff' => function ($query) {                    }]);
                }
                ]);
            },
        ])->findOrFail($this->id);
    }

    public function render()
    {
//        return view('livewire.cms2.leed.item');
        return view('livewire.cms2.leed.item2504');
    }
}
