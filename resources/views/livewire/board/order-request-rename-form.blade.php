<div>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <select wire:model.live="board_id">
        <option value="">Выберите доску</option>
        @foreach($boards as $board)
        <option value="$board->id">{{$board->name}}</option>
        @endforeach
    </select>

        @if ($board_id)
    <form wire:submit.prevent="save">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Оригинальное поле</th>
                <th class="border border-gray-300 px-4 py-2">Новое название</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderRequestFields as $field)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 font-mono">{{ $field }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <input type="text" wire:model.defer="fields.{{ $field }}"
                               class="w-full p-1 border rounded" placeholder="Введите новое название">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Сохранить
        </button>

    </form>
            @endif
</div>
