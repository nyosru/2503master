<?php

namespace App\Livewire\Board\Leed;

use Livewire\Component;
//use App\Models\LeedRecord;

class ItemMiniCommentForm extends Component
{
    public $comment_now;
    public $leed_id;
    public $leed;

    public function mount($leed)
    {
        $this->leed = $leed;
        $this->leed_id = $leed->id;
    }

    public function addComment()
    {
        $this->validate([
            'comment_now' => 'required|string|min:1|max:1000'
        ]);

        try {
            // Правильное создание комментария через отношение
            $this->leed->leedComments()->create([
                'comment' => $this->comment_now,
                'user_id' => auth()->id(),
                'readed' => false
            ]);

            // Очищаем поле после успешного добавления
            $this->comment_now = '';

            // Обновляем данные лида (если нужно)
            $this->leed->refresh();

            session()->flash('success_add_comment', 'Комментарий добавлен');

        } catch (\Exception $e) {
            logger()->error('Error adding comment: ' . $e->getMessage());
            session()->flash('error_add_comment', 'Произошла ошибка при добавлении комментария');
        }
    }

    public function render()
    {
        return view('livewire.board.leed.item-mini-comment-form');
    }
}
