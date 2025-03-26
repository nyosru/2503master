<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\Logs2;
use Livewire\Component;

class ItemComment extends Component
{
    public $leed_record_id;
    protected $comments;
    public $newComment = '';
    public $showFomrAdd = false;
    public $showTehComment = false;


    protected $rules = [
        'newComment' => 'required|string|max:500',
    ];

    public function changeShowTehComment()
    {
        $this->showTehComment = !$this->showTehComment;
        $this->loadComment();
    }

    public function changeShowFomrAdd()
    {
        $this->showFomrAdd = !$this->showFomrAdd;
        $this->newComment = '';
    }

    public function addComment()
    {
        $this->validate();

        Logs2::create([
            'comment' => $this->newComment,
//            'leed_record_id' => $this->leedRecordId,
            'leed_record_id' => $this->leed_record_id,
            'autor_id' => auth()->id(),
            'created_at' => now(),
        ]);

//        session()->flash('message', 'Комментарий успешно добавлен!');
        session()->flash('commentAddOkMsg', 'Комментарий успешно добавлен!');

        $this->showFomrAdd = false;
//        $this->newComment = ''; // Очистка поля

        $this->loadComment();
    }

    public function loadComment()
    {
        $this->comments = Logs2::where('leed_record_id', $this->leed_record_id)
            ->with([
                'user' => function ($query) {
                    $query->withTrashed();
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        $this->loadComment();
        return view('livewire.cms2.leed.item-comment', ['comments' => $this->comments]);
    }
}
