<?php

namespace App\Livewire\Cms2\Leed;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\LeedRecordComment as LeedComment;
use App\Models\LeedCommentFile;

class CommentAdd extends Component
{
    use WithFileUploads;

//    #[Validate('required|string|min:1')]
    public $newComment;

//    #[Validate(['files.*' => 'file|max:100024'])]
//    #[Validate('file|max:100024')]
    public $ffiles = [];

//    public $leed_id; // Идентификатор записи, к которой добавляется комментарий
    public $leed_record_id; // Идентификатор записи, к которой добавляется комментарий



    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    public function save()
    {

        foreach ($this->photos as $photo) {
            $p = $photo->store( 'photos');
//            dd([$this->photos,$p]);
        }
    }


    public function mount($leed_record_id)
    {
        $this->leed_record_id = $leed_record_id;
    }

//    protected $rules = [
//        'newComment' => 'required|string|min:2',
//        'ffiles' => 'file|max:100240', // Макс. 10MB на файл
//    ];

    public function addComment()
    {
//        $vv = $this->validate();
//        dd([$vv, $this->ffiles]);

        $in = [
//            'leed_id' => $this->leed_id,
            'leed_record_id' => $this->leed_record_id,
            'user_id' => Auth::id(),
            'comment' => $this->newComment,
        ];

        // Создаём комментарий
        $comment = LeedComment::create($in);

        // Сохранение файлов
        foreach ($this->ffiles as $file) {
            $path = $file->store('comments', 'public'); // Загружаем в storage/app/public/comments
            LeedCommentFile::create([
                'leed_record_comment_id' => $comment->id,
                'user_id' => Auth::id(),
                'path' => $path,
                'file_name' => $file->getClientOriginalName(), // Оригинальное название файла
            ]);
        }

        // Очистка формы
        $this->reset(['newComment', 'ffiles']);
        $this->dispatch('commentAdded'); // Отправляем событие, если нужно обновить список
    }

    public function render()
    {
        return view('livewire.cms2.leed.comment-add');
    }
}
