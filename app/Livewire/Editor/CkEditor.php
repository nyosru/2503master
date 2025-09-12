<?php

namespace App\Livewire\Editor;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;

class CkEditor extends Component
{

    use WithFileUploads;

    public $contentId;
    public $htmlContent = '';
    public $title = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'htmlContent' => 'required|string',
    ];

    public function mount($contentId = null)
    {
        if ($contentId) {
            $content = Content::findOrFail($contentId);
            $this->contentId = $content->id;
            $this->title = $content->title;
            $this->htmlContent = $content->content;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'content' => $this->htmlContent,
        ];

        if ($this->contentId) {
            $content = Content::find($this->contentId);
            $content->update($data);
        } else {
            $content = Content::create($data);
            $this->contentId = $content->id;
        }

        session()->flash('message', 'Контент успешно сохранен!');
    }


    public function render()
    {
        return view('livewire.editor.ck-editor');
    }
}
