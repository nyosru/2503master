<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecord;
use Livewire\Component;

class Item extends Component
{
    public $id;
    public $board_id;
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
//            dd($showTab);
            $this->changeShowTab($showTab);
        }

        $board_id = $this->board_id;

        $this->leed = LeedRecord::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'column' => function ($query) use ($board_id) {
                $query->with([
                    'board' => function ($query) use ($board_id) {
                        $query->select('id', 'name');
                        $query->with([
                            'fieldSettings' => function ($q2) use ($board_id) {
                                $q2->orderBy('sort_order', 'DESC');
                                $q2->whereIsEnabled(true);
                                $q2->select('board_id', 'field_name', 'is_enabled', 'show_on_start');
                                $q2->with([
                                    'orderRequest' => function ($q3) use ($board_id) {
                                        $q3->with(['rename' => function ($q31) use ($board_id) {
                                            $q31->where('board_id', '=', $board_id);
//                                            $q31->where('board_id', '=', 'record_columns.board_id');
//                                            dump( $q31->toSql() );
                                        }]);
                                    }
                                ]);
                            }
                        ]);
                    }
                ]);
            },
            'supplier' => function ($query) {
                $query->withTrashed();
            },
            'userChanges' => function ($query) {
                $query->orderBy('created_at', 'desc');
                $query->with(['newUser' => function ($query) {
                    $query->withTrashed();
                    $query->with(['roles' => function ($query) {
                    }]);
//                    $query->with(['staff' => function ($query) {                    }]);
                }
                ]);
            },
        ])->findOrFail($this->id);

//        dump( $this->leed->toSql() );
    }

    public function render()
    {

//        dd($e->toArray());

//        return view('livewire.cms2.leed.item');
        return view('livewire.cms2.leed.item2504');
    }
}
