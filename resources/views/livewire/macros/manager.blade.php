<div class="max-w-xl mx-auto p-4 border rounded shadow">


    {{-- Выбор доски --}}
    <div>
        <label for="board_id" class="block font-semibold mb-1">Выберите доску</label>
        <select id="board_id" wire:model.live="board_id" class="w-full p-2 border rounded">
            <option value="">-- Выберите доску --</option>
            @foreach($boards as $board)
                <option value="{{ $board->id }}">{{ $board->name }}</option>
            @endforeach
        </select>
    </div>

    board_id: {{ $board_id ?? 'x' }}

    <livewire:macros.create-form :board_id="$board_id" :key="'macros_add_form'.$board_id"/>

    <livewire:macros.listing :board_id="$board_id" :key="'macros_listing'.$board_id"/>

</div>
