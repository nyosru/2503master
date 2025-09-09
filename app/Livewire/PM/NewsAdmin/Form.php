<?php

namespace App\Livewire\PM\NewsAdmin;

use App\Models\News;
use App\Models\Board;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $newsId;
    public $title;
    public $excerpt;
    public $content;
    public $image;
    public $board_id;
    public $is_published = false;
    public $published_at;
    public $existingImage;

    protected $rules = [
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'board_id' => 'nullable|exists:boards,id',
        'is_published' => 'boolean',
        'published_at' => 'nullable|date',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $news = News::findOrFail($id);
            $this->newsId = $news->id;
            $this->title = $news->title;
            $this->excerpt = $news->excerpt;
            $this->content = $news->content;
            $this->board_id = $news->board_id;
            $this->is_published = $news->is_published;
            $this->published_at = $news->published_at?->format('Y-m-d\TH:i');
            $this->existingImage = $news->image;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'board_id' => $this->board_id,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? ($this->published_at ?? now()) : null,
            'author_user_id' => auth()->id(),
        ];

        if ($this->image) {

            // Удаляем старое изображение
            if ($this->existingImage) {
                Storage::delete('news/' . $this->existingImage);
            }

            // Сохраняем новое изображение
            $filename = ($this->board_id ?? '') . '_' . time() . '_' . $this->image->getClientOriginalName();
            $this->image->storeAs('news', $filename, 'public');
            $data['image'] = $filename;
        }

        if ($this->newsId) {
            $news = News::findOrFail($this->newsId);
            $news->update($data);
            session()->flash('success', 'Новость успешно обновлена');
        } else {
            News::create($data);
            session()->flash('success', 'Новость успешно создана');
        }

        return redirect()->route('tech.news-admin');
    }

    public function removeImage()
    {
        if ($this->existingImage) {
            Storage::delete('public/news/' . $this->existingImage);
            News::where('id', $this->newsId)->update(['image' => null]);
            $this->existingImage = null;
            session()->flash('success', 'Изображение удалено');
        }
    }

    public function render()
    {
        return view('livewire.p-m.news-admin.form', [
            'boards' => Board::all(),
            'isEdit' => !is_null($this->newsId)
        ]);
    }
}
