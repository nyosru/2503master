<div>

    <h2 class="text-lg font-bold"> Добавить макрос </h2>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save">

        @if( empty($column) )
            <div>
                <label>Колонка (ID)</label>
                <input type="text" wire:model.defer="form.columns.0" readonly/>
            </div>
        @endif

        @if( empty($type) )
            <div>
                <label>Тип</label>
                <input type="text" wire:model.defer="form.type" readonly/>
            </div>
        @endif


        <div>
            <label>Название макроса</label>
            <input type="text" wire:model.defer="form.name"/>
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Комментарий</label>
            <textarea wire:model.defer="form.comment"></textarea>
            @error('form.comment') <span class="error">{{ $message }}</span> @enderror
        </div>


        <div>
            <label>День</label>
            <input type="number" wire:model.defer="form.day" min="1" step="1" max="366" />
            @error('form.day') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Переместить в колонку</label>
            <select wire:model.defer="form.move_to_column">
                <option value="">-- Выберите колонку --</option>
                @foreach($columnsList as $col)
                    <option value="{{ $col->id }}">{{ $col->name }}</option>
                @endforeach
            </select>
            @error('form.move_to_column') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-400 px-2 py-1 rounded">Добавить макрос</button>
    </form>
</div>
