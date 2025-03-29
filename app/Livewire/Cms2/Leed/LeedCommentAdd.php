<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedCommentFile;
use App\Models\User;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Debug\Debug;


class LeedCommentAdd extends Component
{
    use WithFileUploads;

    public $leed_record_id;

    public $message;
    public $fi = [];
    public $parentCommentId;
    public $users;
    public $addressed_to_user_id;
    protected $listeners = [
        'set-reply-to' => 'setReplyTo'
    ];

    public function setReplyTo($id)
    {
        $this->parentCommentId = $id;
    }

    public function updateParentCommentId($commentId)
    {
        $this->parentCommentId = $commentId;
    }

    public function mount($leed_record_id)
    {
        $this->leed_record_id = $leed_record_id;
        $this->users = User::select('id', 'name')
            ->with([
                'roles',
//                'roles' => function ($query) {
//                    $query
////                        ->first()
//                    ->selectRaw('name as role_name');
//                },
//                'staff' => function ($query) {
//                    $query->select('id', 'name', 'department');
//                }
            ])
            ->get();
    }

    protected $rules = [
////        'message' => 'required|string|min:1|max:255',
//        'message' => 'required|string|min:1',
        'message' => 'nullable|string',
////        'files.*' => 'file|mimes:jpeg,png,pdf,docx,txt|max:10240', // можно добавить любые разрешенные форматы файлов
//        'files.*' => 'file|max:1000240', // можно добавить любые разрешенные форматы файлов
//        'fi.*' => 'file|max:1000240',
        'fi.*' => 'file',
        // можно добавить любые разрешенные форматы файлов
    ];

    public function addComment()
    {
        $this->validate();

        // Создаем новый комментарий
        $comment = \App\Models\LeedRecordComment::create([
            'leed_record_id' => $this->leed_record_id,
            'user_id' => Auth::id(),
            'comment' => $this->message,
            'parent_id' => $this->parentCommentId, // Сохраняем ID родительского комментария
            'addressed_to_user_id' => $this->addressed_to_user_id, // кому комментарий
        ]);

        if (!empty($this->parentCommentId)) {
            $l = \App\Models\LeedRecordComment::select('id')->whereId($this->parentCommentId)->where(
                'user_id',
                '!=',
                Auth::id()
            )->first();
            if ($l) {
                $l->readed = true;
                $l->save();
            }
        }

        $e = [];
        foreach ($this->fi as $file) {
            $e[] =
            $path = $file->store('leed-comments', 'public');
            $f = [
                'leed_record_comment_id' => $comment->id,
                'path' => $path,
                'user_id' => Auth::id(),
                'file_name' => $file->getClientOriginalName(), // Сохраняем оригинальное имя файла
            ];
            LeedCommentFile::create($f);
        }
        $this->reset('message', 'fi');

        // Очищаем поля после сохранения
        $this->message = '';
        $this->fi = [];
        session()->flash('message', 'Комментарий и файлы успешно добавлены!');
        $this->redirectRoute('leed.item', ['id' => $this->leed_record_id, 'showTab' => 'comment']);
    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-comment-add');
    }
}
