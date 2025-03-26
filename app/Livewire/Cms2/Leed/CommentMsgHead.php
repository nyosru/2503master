<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedRecordComment as LeedRecordCommentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentMsgHead extends Component
{
    public $comment;
//    public $user;
    public $thisAutor;
    public $user_up = '';

    public function mount($comment,$user_up = '')
    {
        $this->user_up = $user_up;
//        $this->user = Auth::id();
//        $this->thisAutor = $thisAutor;
        $this->comment = $comment;
        $this->thisAutor = $comment->user->id ==  Auth::id();
    }


//    public function setReadedComment( $id ){
    public function setReadedComment()
    {
//        $comment = LeedRecordCommentModel::findOrFail($id);
        $this->comment->readed = true;
        $this->comment->save();
//        $this->dispatch('refreshComments');
        $this->dispatch('commentInfRefresh');
    }

    public function reply($commentId)
    {
        $this->dispatch('set-reply-to', id: $commentId);
    }

//    public function setAnswerComment($id){
//        $this->dispatch('setAnswerComment');
//    }
    public function render()
    {
        return view('livewire.cms2.leed.comment-msg-head');
    }
}
