<div>

    @if(session()->has('success'))
        <div style="color: green; margin-bottom: 0.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div style="color: red; margin-bottom: 0.5rem;">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <label for="domain-select">Домен для доски:</label>
        <select id="domain-select" wire:model="selectedDomainId" class="border rounded p-1 mt-1 mb-3 w-full">
            <option value="">-- Без домена --</option>
            @foreach($domains as $domain)
                <option value="{{ $domain['id'] }}">{{ $domain['name'] }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Установить домен
        </button>
    </form>

</div>
