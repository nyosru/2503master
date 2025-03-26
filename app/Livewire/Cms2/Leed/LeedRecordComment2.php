<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedCommentFile;
use App\Models\LeedRecordComment as LeedRecordCommentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeedRecordComment2 extends Component
{
    use WithFileUploads;

    public $leed_record_id;
    public $leedRecordId;
    public $comments;
    public $newComment = '';
    public $files = []; // Добавляем массив файлов

    public function mount($leedRecordId)
    {
        $this->leed_record_id = $leedRecordId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = LeedRecordCommentModel::where('leed_record_id', $this->leed_record_id)
            ->with('files')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    protected $rules = [
        'newComment' => 'required|string|min:3',
        'files.*' => 'file|max:10240', // Ограничение: 10MB на файл
    ];

    public function addComment()
    {
        $this->validate();

        $comment = LeedRecordCommentModel::create([
            'leed_record_id' => $this->leed_record_id,
            'user_id' => Auth::id(),
            'comment' => $this->newComment,
        ]);

        // Сохранение файлов
        foreach ($this->files as $file) {
            $originalName = $file->getClientOriginalName(); // Получаем оригинальное имя файла
            $path = $file->store('comments', 'public'); // Загружаем в storage/app/public/comments
//            dd($path);
            $in = [
                'leed_record_comment_id' => $comment->id,
                'user_id' => Auth::id(),
                'path' => $path,
                'file_name' =>  $originalName, // Сохраняем оригинальное имя файла
            ];
            LeedCommentFile::create($in);
        }

        // Очистка после загрузки
        $this->newComment = '';
        $this->files = [];
        $this->loadComments();
    }

    public function deleteComment(int $commentId)
    {
        $comment = LeedRecordCommentModel::find($commentId);
        if ($comment) {
            $comment->delete();
            $this->loadComments();
        }
    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-record-comment');
    }
}
