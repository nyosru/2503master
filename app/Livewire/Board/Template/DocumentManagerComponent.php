<?php

namespace App\Livewire\Board\Template;

use App\Models\Board;
use App\Models\BoardDocumentTemplate;
use App\Models\LeedRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentManagerComponent extends Component
{
    use WithFileUploads;

    public Board $board;

    public $name = '';
    public $content = '';
    public $file;
    public ?BoardDocumentTemplate $editingTemplate = null;
    public $filePath = null;


    public function mounted()
    {
        $this->dispatchBrowserEvent('init-tinymce');
    }

    protected $listeners = ['updateContent'];

    public function updateContent($value)
    {
        $this->content = $value;
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:rtf',
        ];
    }

    public function render()
    {
        return view('livewire.board.template.document-manager-component', [
            'templates' => $this->board->documentTemplates()->latest()->get(),
        ]);
    }



    public function saveContent()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $fileName = 'doc_' . time() . '.html';

        Storage::disk('public')->put(
            "board-templates/{$this->board->id}/{$fileName}",
            $this->content
        );

        $this->filePath = "board-templates/{$this->board->id}/{$fileName}";

        session()->flash('success', 'Документ сохранён через редактор');
    }


    public function save(): void
    {
        $this->validate();

        $filePath = null;

        if ($this->file) {
            $filePath = $this->file->store("board-templates/{$this->board->id}", 'public');
        }

        $this->board->documentTemplates()->create([
            'name' => $this->name,
            'file_path' => $filePath,
        ]);

        session()->flash('message', 'Шаблон загружен');
        $this->reset(['name', 'file']);
    }

    public function delete(BoardDocumentTemplate $template): void
    {
        if ($template->file_path) {
            Storage::delete($template->file_path);
        }
        $template->delete();

        session()->flash('message', 'Шаблон удалён');
    }

    public function generate(BoardDocumentTemplate $template, LeedRecord $leed): string
    {
        $content = Storage::get($template->file_path);

        $replacements = [
            '{{board.name}}' => $this->board->name,
            '{{leed.name}}' => $leed->name,
            '{{leed.phone}}' => $leed->phone,
            // можно расширить список замен
        ];

        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        $filename = "generated_{$template->id}.rtf";
        Storage::put("generated-docs/{$filename}", $content);

        return Storage::path("generated-docs/{$filename}");
    }
}
