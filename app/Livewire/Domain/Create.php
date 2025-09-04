<?php

namespace App\Livewire\Domain;

use Livewire\Component;
use App\Models\Domain;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public string $domain = '';
    public string $domain_ru = '';
    public ?int $admin_user_id = null;

    protected array $rules = [
        'domain' => ['required', 'string', 'max:255', 'unique:domains,domain'],
    ];

    public function mount(?int $adminUserId = null)
    {
        $this->admin_user_id = $adminUserId ?? Auth::id();
    }

    public function updatedDomain(string $value)
    {
        $parsed = parse_url(trim($value));
        $domain_ru = $parsed['host'] ?? $value;
        $cleanDomain = trim($domain_ru);
        $this->domain_ru = $cleanDomain;

//        if ( $this->domain_ru != $this->toPunycode($cleanDomain) ) {}
            $this->domain = $this->toPunycode($cleanDomain);
//        } else {
//            $this->domain = $cleanDomain;
//        }
    }

    protected function toPunycode(string $domain): string
    {
        return idn_to_ascii($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46) ?: $domain;
    }

    public function save()
    {
        $this->validate();

        Domain::create([
            'domain' => $this->domain,
            'domain_ru' => $this->domain_ru,
            'admin_user_id' => $this->admin_user_id,
        ]);

        session()->flash('success', 'Домен успешно добавлен');

        $this->reset(['domain', 'domain_ru']);
    }

    public function deleteDomain(int $domainId)
    {
        $domain = Domain::where('id', $domainId)
            ->when($this->admin_user_id, fn($query, $adminId) => $query->where('admin_user_id', $adminId))
            ->first();

        if ($domain) {
            $domain->delete();
            session()->flash('success', 'Домен успешно удалён');
        } else {
            session()->flash('error', 'Домен не найден или доступ запрещён');
        }
    }

    public function render()
    {
        $domains = Domain::when($this->admin_user_id, fn($query, $adminId) => $query->where('admin_user_id', $adminId))
            ->latest()->get();

        return view('livewire.domain.create', [
            'domains' => $domains,
        ]);
    }
}
