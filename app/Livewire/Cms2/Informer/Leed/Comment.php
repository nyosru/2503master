<?php

namespace App\Livewire\Cms2\Informer\Leed;

use App\Models\LeedRecord;
use App\Models\LeedRecordComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $leed;
    public $count = 0;
    public $totalCount;

    protected $listeners = [
        // обновляем список текущих коментов
        'commentInfRefresh' => 'load',
//        'loadComments' => 'commentAdded',

    ];
    public function mount(LeedRecord $leed)
    {
        $this->leed = $leed;
    }

    public function load()
    {
        $user_id = Auth::id();

//        $this->count = $this->leed->leedComments()
//            ->where('user_id', '!=', $user_id)
//            ->where('parentComment', function ($query) use ($user_id) {
//                $query->where('user_id', $user_id);
//            })
//            ->where('readed', false)
//            ->count();
        $this->count = LeedRecordComment::where('leed_record_comments.leed_record_id', $this->leed->id)
            ->join('leed_record_comments as parents', 'leed_record_comments.parent_id', '=', 'parents.id')
            ->where('leed_record_comments.user_id', '!=', $user_id)
            ->where('parents.user_id', $user_id)
            ->where('leed_record_comments.readed', false)
            ->count();
// Общее количество комментариев
        $this->totalCount = $this->leed->leedComments()->count();
    }

    public function render()
    {
        $this->load();
        return view('livewire.cms2.informer.leed.comment');
    }
}
