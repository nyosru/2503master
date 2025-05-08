<?php

namespace App\Livewire\File;

use App\Models\FileUpload;
use App\Models\LeedCommentFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddForm extends Component
{

    use WithFileUploads;

    public $leed_record_id;

    public $message;
    public $name;
    public $board_id;
    public $fi = [];
//    #[Validate([
//        'files' => ['array'],
//        'files.*' => ['file', 'max:102400'],
//    ])]
    public $files = [];
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

//    public function mount($leed_record_id)
    public function mount()
    {

//        $this->leed_record_id = $leed_record_id;
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

//    protected $rules = [
////////        'message' => 'required|string|min:1|max:255',
//////        'message' => 'required|string|min:1',
//        'message' => 'nullable|string',
////////        'files.*' => 'file|mimes:jpeg,png,pdf,docx,txt|max:10240', // можно добавить любые разрешенные форматы файлов
////        'files.*' => 'file|max:1000240', // можно добавить любые разрешенные форматы файлов
//        'files.*' => 'nullable|file', // можно добавить любые разрешенные форматы файлов
//////        'fi.*' => 'file|max:1000240',
////        'fi.*' => 'file',
////        // можно добавить любые разрешенные форматы файлов
//    ];

    public function addFile($leed_id)
    {
//        $this->validate();

//        // Создаем новый комментарий
//        $comment = FileUpload::create([
//            'leed_record_id' => $this->leed_record_id,
//            'user_id' => Auth::id(),
//
//            'comment' => $this->message,
//
////            'parent_id' => $this->parentCommentId, // Сохраняем ID родительского комментария
////            'addressed_to_user_id' => $this->addressed_to_user_id, // кому комментарий
//
//        ]);

//        if (!empty($this->parentCommentId)) {
//            $l = \App\Models\LeedRecordComment::select('id')->whereId($this->parentCommentId)->where(
//                'user_id',
//                '!=',
//                Auth::id()
//            )->first();
//            if ($l) {
//                $l->readed = true;
//                $l->save();
//            }
//        }

        $e = [];
        foreach ($this->fi as $file) {
//            $e[] =

//                try {
//                    $bucket = env('AWS_BUCKET');
//                    $exists = Storage::disk('s3')->exists(''); // Проверка корня бакета
//
//                    // Или проверить конкретный файл, если он есть
//                    // $exists = Storage::disk('s3')->exists('some-file.txt');
//
//                    if ($exists) {
//                        echo "Подключение к S3 успешно, бакет доступен.";
//                    } else {
//                        echo "Подключение к S3 успешно, но бакет пуст или файл не найден.";
//                    }
//                } catch (\Exception $e) {
//                    echo "Ошибка подключения к S3: " . $e->getMessage();
//                }

//            // Загрузка файла в папку 'uploads' на S3
////            $path = Storage::disk('s3')->put('uploads', $request->file('file'));
//            $path = Storage::disk('s3')->put('uploads', $request->file('file'));
//            // Получить публичную ссылку (если нужно)
//            $url = Storage::disk('s3')->url($path);

//            $path = $file->store('leed-comments', 's3');
//            $path = $file->store('leed-comments', 's3');
//            $path = Storage::disk('s3')->put('leed-comments', $file );

            $path = $file->store('leed-files', 's3beget');

            $url = Storage::disk('s3beget')->url($path);

//            dd($path, $url, $e, $files ?? []);
//            $path = $file->store('leed-comments', 'public');

            $f = [

//                'leed_record_id' => $this->leed_record_id,
                'leed_record_id' => $leed_id,
//                'path' => $path,

                'file_name' => $file->getClientOriginalName(), // Сохраняем оригинальное имя файла
                'path' => $url,
                's3_path' => $path,

                'user_id' => Auth::id(),
            ];

            if( !empty($this->name) ) {
                $f['name'] = $this->name;
            }

//            dd($f);
            FileUpload::create($f);
        }
        $this->reset('name', 'fi');

        // Очищаем поля после сохранения
        $this->message = '';
        $this->fi = [];
        session()->flash('messageFileAdd', 'Файл успешно добавлены!');

//        return redirect()->back();
        $this->redirectRoute('leed.item', [
            'id' => $this->leed_record_id,
            'board_id' => $this->board_id,
////            'showTab' => 'comment'
        ]);
    }


    public function render()
    {
        return view('livewire.file.add-form');
    }
}
