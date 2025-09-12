<?php

namespace App\Livewire\Editor;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;

class QuillEditor extends Component
{

    use WithFileUploads;

    public $contentId;
    public $htmlContent = '';
    public $title = '';
    public $image;
    public $id = 1;

    protected $rules = [
        'title' => 'required|string|max:255',
        'htmlContent' => 'required|string',
        'image' => 'nullable|image|max:2048',
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
        $this->validate(['htmlContent' => 'required']);

        $data = [
            'title' => $this->title,
            'content' => $this->htmlContent,
        ];

        dd($data);

        if ($this->contentId) {
            $content = Content::find($this->contentId);
            $content->update($data);
        } else {
            $content = Content::create($data);
            $this->contentId = $content->id;
        }

        session()->flash('message', 'Контент успешно сохранен!');
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'required|image|max:2048',
        ]);

        if ($this->image) {
            $path = $this->image->store('editor-images', 'public');
            $url = Storage::disk('public')->url($path);

            $this->dispatch('image-uploaded', url: $url);
            $this->reset('image');
        }
    }

    public function render()
    {
        return view('livewire.editor.quill-editor');
    }
}
