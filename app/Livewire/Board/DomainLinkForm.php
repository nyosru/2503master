<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DomainLinkForm extends Component
{

    public int $board_id;
    public ?int $user_id = null;

    public ?int $selectedDomainId = null;
    public array $domains = [];

    public function mount(int $board_id, ?int $user_id = null)
    {
        $this->board_id = $board_id;
        $this->user_id = $user_id ?? Auth::id();

        $this->loadDomains();
        $this->loadCurrentDomain();
    }

    protected function loadDomains(): void
    {
        // Загружаем домены, которыми управляет текущий админ (user_id)
        $this->domains = Domain::where('admin_user_id', $this->user_id)
            ->orderBy('domain')
            ->get()
            ->map(fn($domain) => ['id' => $domain->id, 'name' => $domain->domain])
            ->toArray();
    }

    protected function loadCurrentDomain(): void
    {
        $board = Board::find($this->board_id);
        $this->selectedDomainId = $board && $board->domain_id ? $board->domain_id : null;
    }

    public function updatedSelectedDomainId($value)
    {
        // Можно добавить моментальную валидацию или логику при изменении выбора
    }

    public function save()
    {
        $board = Board::find($this->board_id);

        if (!$board) {
            session()->flash('error', 'Доска не найдена.');
            return;
        }

        // Проверяем, что выбранный домен принадлежит текущему user_id (админу)
        if ($this->selectedDomainId !== null) {
            $domainExists = Domain::where('id', $this->selectedDomainId)
                ->where('admin_user_id', $this->user_id)
                ->exists();

            if (!$domainExists) {
                session()->flash('error', 'Выбранный домен недоступен.');
                return;
            }
        }

        $board->domain_id = $this->selectedDomainId;
        $board->save();

        session()->flash('success', 'Домен успешно установлен для доски.');
    }



    public function render()
    {
        return view('livewire.board.domain-link-form');
    }
}
