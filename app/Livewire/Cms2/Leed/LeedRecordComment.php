<?php

namespace App\Livewire\Cms2\Leed;

use App\Models\LeedCommentFile;
use App\Models\LeedRecordComment as LeedRecordCommentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeedRecordComment extends Component
{
    use WithFileUploads;

    public $leed_record_id;
    public $comments;
    public $newComment = '';
    public $files = []; // Добавляем массив файлов

    protected $listeners = [
        // обновляем список текущих коментов
        'commentAdded' => 'loadComments',
        'loadComments' => 'commentAdded',

    ];


    public function mount($leedRecordId)
    {
        $this->leed_record_id = $leedRecordId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = LeedRecordCommentModel::where('leed_record_id', $this->leed_record_id)
            ->whereNull('parent_id') // Выбрать только корневые комментарии
            ->with([
                'files',
                'user' => function ($query) {
                    $query->withTrashed();
                    $query->select('id', 'name', 'deleted_at');
                    $query->with([
                        'roles' => function ($q2) {
                            $q2->select('name')->first();
                        }
                    ]);
                },
                'addressedToUser' => function ($query) {
                    $query->withTrashed();
                    $query->select('id', 'name', 'deleted_at');
                    $query->with([
                        'roles' => function ($q2) {
                            $q2->select('name')->first();
                        }
                    ]);
                },
                'childComments' => function ($query) {
                    $query->with([
                        'files',
                        'user' => function ($query2) {
                            $query2->withTrashed();
                            $query2->select('id', 'name', 'deleted_at');
                            $query2->with([
                                'roles' => function ($q3) {
                                    $q3->select('name')->first();
                                }
                            ]);
                        }
                    ]);
                },
            ])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    protected $rules = [
        'newComment' => 'required|string|min:3',
        'files.*' => 'file|max:10240', // Ограничение: 10MB на файл
    ];


    public function removeFile($index)
    {
        // Удаляем файл из массива по индексу
        array_splice($this->files, $index, 1);
    }

    public function deleteComment(int $commentId)
    {
        $comment = LeedRecordCommentModel::find($commentId);

        if ($comment) {
            // Удаляем связанные файлы, если необходимо
            foreach ($comment->files as $file) {
                \Storage::disk('public')->delete($file->path); // Удаляем файл из хранилища
                $file->delete(); // Удаляем запись из базы данных
            }

            // Удаляем сам комментарий
            $comment->delete();
            $this->loadComments();
        }
    }

    public function render()
    {
        return view('livewire.cms2.leed.leed-record-comment2504');
    }
}
