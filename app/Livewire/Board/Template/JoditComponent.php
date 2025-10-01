<?php

namespace App\Livewire\Board\Template;

use Livewire\Component;
use App\Models\Board;
use App\Models\BoardTemplate;

class JoditComponent extends Component
{
    public Board $board;
    public $templates;
    public $name;
    public $content;
    public $editingTemplateId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'content' => 'nullable|string',
    ];

    public function mount(Board $board)
    {
        $this->board = $board;
        $this->loadTemplates();
    }

    public function loadTemplates()
    {
        $this->templates = $this->board->documentTemplates()->latest()->get();
    }

    public function editTemplate($id)
    {
        $template = BoardTemplate::findOrFail($id);
        $this->editingTemplateId = $template->id;
        $this->name = $template->name;
        $this->content = $template->content;
    }

    public function saveTemplate()
    {
        $this->validate();

        if ($this->editingTemplateId) {
            $template = BoardTemplate::findOrFail($this->editingTemplateId);
            $template->update([
                'name' => $this->name,
                'content' => $this->content,
            ]);
        } else {
            BoardTemplate::create([
                'board_id' => $this->board->id,
                'name' => $this->name,
                'content' => $this->content,
            ]);
        }

        $this->resetForm();
        $this->loadTemplates();
        session()->flash('success', 'Шаблон сохранён');
    }

    public function deleteTemplate($id)
    {
        $template = BoardTemplate::findOrFail($id);
        $template->delete();
        $this->loadTemplates();
        session()->flash('success', 'Шаблон удалён');
    }

    public function resetForm()
    {
        $this->editingTemplateId = null;
        $this->name = '';
        $this->content = '';
    }


    public function render()
    {
        return view('livewire..board.template.jodit-component');
    }
}
