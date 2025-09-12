<?php

namespace App\Livewire\Editor;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Content as Post;
use Illuminate\Support\Str;

class CkEditorCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $content = '';
    public $excerpt = '';
    public $featured_image;
    public $is_published = false;
    public $tags = '';

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
        'excerpt' => 'nullable|string|max:300',
        'featured_image' => 'nullable|image|max:2048',
        'tags' => 'nullable|string|max:255',
        'is_published' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        // Обработка изображения
        $imagePath = null;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('posts', 'public');
        }

        // Создание записи
        Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'featured_image' => $imagePath,
            'tags' => $this->tags,
            'is_published' => $this->is_published,
            'user_id' => auth()->id() ?? 1, // временно для теста
        ]);

        // Сброс формы
        $this->reset();

        session()->flash('success', 'Запись успешно создана!');
    }

    public function render()
    {
        return view('livewire.editor.ck-editor-create')
            ->layout('layouts.app-simple');
    }
}
