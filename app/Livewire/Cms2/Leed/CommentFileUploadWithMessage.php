<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedCommentFile;
use App\Models\LeedRecordComment as LeedComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CommentFileUploadWithMessage extends Component
{
    use WithFileUploads;

//    #[Validate('required|string|min:1')]
    public $message;  // Сообщение, которое будет отправлено

//    #[Validate(['ffiles.*' => 'file|max:100024'])]
    public $ffiles = [];  // Массив загружаемых файлов

    public $leed_record_id; // Идентификатор записи, к которой добавляется комментарий
    public $uploadedFiles = []; // Массив для отображения загруженных файлов

    public function mount($leed_record_id)
    {
        $this->leed_record_id = $leed_record_id;
    }

//    // Правила валидации
//    protected $rules = [
//        'message' => 'required|string|min:1',  // Минимум 5 символов для сообщения
//////        'files.*' => 'file|mimes:jpg,png,pdf,docx,txt|max:10240',  // Ограничение для файлов
//        'ffiles' => 'file|max:51240',  // Ограничение для файлов
//        'ffiles.*' => 'file|max:51240',  // Ограничение для файлов
//    ];

    public function submit()
    {
        // Валидация данных
        $e = $this->validate([
            'message' => 'required|string|min:1',  // Минимум 5 символов для сообщения
            'ffiles.*' => 'file|max:51240',  // Ограничение для файлов
        ]);
//        dd($e);
//        dd([$e,$this->ffiles]);

        // Логика отправки сообщения
        // Здесь можно сохранить сообщение в базе данных, если нужно


        // Создаём комментарий
        $in = [
            'leed_record_id' => $this->leed_record_id,
            'user_id' => Auth::id(),
            'comment' => $this->message,
        ];
        $comment = LeedComment::create($in);

        // Логика загрузки файлов
        foreach ($this->ffiles as $file) {
            $path = $file->storePublicly('comment');  // Сохраняем файл в storage/app/public/messages
            dd($path);
            LeedCommentFile::create([
//                'leed_record_comment_id' => $comment->id,
                'leed_record_comment_id' => 77,
                'user_id' => Auth::id(),
                'path' => $path,
                'file_name' => $file->getClientOriginalName(), // Оригинальное название файла
            ]);
//            dd([$e,$path]);
        }

        // Очистка после отправки
//        $this->reset(['message', 'files']);

        $this->message = '';
        $this->ffiles = [];
        $this->uploadedFiles = [];

        // Отправляем событие о успешной отправке
        session()->flash('success', 'Сообщение и файлы успешно отправлены!');
    }

    public function render()
    {
        return view('livewire.cms2.leed.comment-file-upload-with-message');
    }
}
