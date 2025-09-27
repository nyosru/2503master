<?php

namespace App\Livewire\Board\Leed;

use App\Models\Document;
use Livewire\Component;

class ItemMiniDocumentLinks extends Component
{
    public $leed;
    public $documentLinks = [];
    public array $documentsTemplates = [];


    public function mount($leed)
    {
        $this->leed = $leed;
        $documents = Document::where('leed_id', $leed->id)->get();
        foreach ($documents as $doc) {
            $this->documentsTemplates[$doc->id] = $doc->url_template;
        }
        $this->generateLinks();
    }


    public function generateLinks()
    {
        $this->documentLinks = [];

        $documents = Document::where('leed_id', $this->leed->id)->get();

        foreach ($documents as $doc) {
            // Подставляем id лида в URL шаблон
            $url = str_replace('{{leed_id}}', $this->leed->id, $doc->url_template);
            $this->documentLinks[] = [
                'name' => $doc->name,
                'url' => $url,
                'id' => $doc->id,
            ];
        }
    }

    public function editDocument($documentId, $newTemplate)
    {
        $document = Document::find($documentId);

        if ($document) {
            $document->url_template = $newTemplate;
            $document->save();
            $this->generateLinks();
        }
    }


    /**
     * Вызывать для обновления (если данные лида меняются динамически)
     */
    public function updatedLeed()
    {
        $this->generateLinks();
    }

    /**
     * Распечатать документ — открывает новую вкладку с печатью
     */
    public function printDocument($url)
    {
        $this->dispatchBrowserEvent('printDocument', ['url' => $url]);
    }


    public function render()
    {
        return view('livewire.board.leed.item-mini-document-links');
    }
}
