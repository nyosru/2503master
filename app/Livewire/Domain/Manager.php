<?php

namespace App\Livewire\Domain;

use App\Models\Domain;
use Livewire\Component;
use Livewire\WithPagination;

class Manager extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortField = 'domain';
    public $sortDirection = 'asc';

    // Форма создания/редактирования
    public $domainId;
    public $domain;
    public $domain_ru;
    public $admin_user_id;
    public $isEditing = false;

    protected $rules = [
        'domain' => 'required|string|max:255|unique:domains,domain',
        'domain_ru' => 'required|string|max:255',
        'admin_user_id' => 'required|exists:users,id',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'domain'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
//        $this->authorize('viewAny', Domain::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
        $this->resetPage();
    }

    public function startCreate()
    {
//        $this->authorize('create', Domain::class);

        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('open-modal', 'domain-form');
    }

    public function startEdit($id)
    {
        $domain = Domain::findOrFail($id);
//        $this->authorize('update', $domain);

        $this->domainId = $domain->id;
        $this->domain = $domain->domain;
        $this->domain_ru = $domain->domain_ru;
        $this->admin_user_id = $domain->admin_user_id;
        $this->isEditing = true;

        $this->dispatch('open-modal', 'domain-form');
    }

    public function saveDomain()
    {
        if ($this->isEditing) {
            $domain = Domain::findOrFail($this->domainId);
//            $this->authorize('update', $domain);

            $this->rules['domain'] = 'required|string|max:255|unique:domains,domain,' . $domain->id;
        } else {
//            $this->authorize('create', Domain::class);
        }

        $this->validate();

        $data = [
            'domain' => $this->domain,
            'domain_ru' => $this->domain_ru,
            'admin_user_id' => $this->admin_user_id,
        ];

        if ($this->isEditing) {
            $domain->update($data);
            session()->flash('success', 'Домен успешно обновлен');
        } else {
            Domain::create($data);
            session()->flash('success', 'Домен успешно создан');
        }

        $this->resetForm();
        $this->dispatch('close-modal', 'domain-form');
    }

    public function deleteDomain($id)
    {
        $domain = Domain::findOrFail($id);
//        $this->authorize('delete', $domain);

        if ($domain->boards()->count() > 0) {
            session()->flash('error', 'Нельзя удалить домен, к которому привязаны доски');
            return;
        }

        $domain->delete();
        session()->flash('success', 'Домен успешно удален');
    }

    private function resetForm()
    {
        $this->reset(['domainId', 'domain', 'domain_ru', 'admin_user_id']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $domains = Domain::with(['adminUser', 'boards'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('domain', 'like', '%' . $this->search . '%')
                        ->orWhere('domain_ru', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view(
//            'livewire.domain-manager',
            'livewire.domain.manager',
            [
            'domains' => $domains,
            'adminUsers' => \App\Models\User::whereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'super_admin']);
            })->get()
        ]);
    }

//    public function render()
//    {
//        return view('livewire.domain.manager');
//    }
}
