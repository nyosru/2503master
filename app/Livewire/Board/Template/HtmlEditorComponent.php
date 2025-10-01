<?php

namespace App\Livewire\Board\Template;

use App\Models\BoardTemplate;
use Livewire\Component;
use Livewire\WithFileUploads;

class HtmlEditorComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $content = '';
    public $image;
    public $editingId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    public function mount($templateId = null)
    {
        if ($templateId) {
            $template = BoardTemplate::findOrFail($templateId);
            $this->editingId = $template->id;
            $this->name = $template->name;
            $this->content = $template->content ?? '';
        }
    }

    public function saveTemplate()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($this->editingId) {
            $template = BoardTemplate::findOrFail($this->editingId);
            $template->update([
                'name' => $this->name,
                'content' => $this->content,
            ]);
        } else {
            BoardTemplate::create([
                'name' => $this->name,
                'content' => $this->content,
            ]);
        }

        session()->flash('success', 'Шаблон успешно сохранён!');
        return redirect()->route('board.templates'); // свой маршрут
    }

    public function render()
    {
        return view('livewire.board.template.html-editor-component');
    }
}
