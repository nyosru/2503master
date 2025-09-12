<div>

    @if(session('success_move_column'))
        <div class="bg-green-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('success_move_column') }}
        </div>
    @endif

    @if(session('error_move_column'))
        <div class="bg-red-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('error_move_column') }}
        </div>
    @endif

    {{--        текущий шаг: {{ $leed->column->name ?? 'x'}}--}}
    <div class="text-center">
        <div class="font-bold text-xl  my-4 ">
            Переместить лида
        </div>
        <select wire:model.live="select_column_id" class="
        max-w-[300px] w-full
        mr-0"
        >
            <option value="">выберите куда переместить</option>
            @foreach ($columns as $column)
                <option
                    :key="'opt'.$column->id"
                    value="{{ $column->id }}">{{ $column->name }} {{ $leed->column->id == $column->id ? '(текущий)' : '' }}</option>
            @endforeach
        </select>
        {{--            select_column_id: {{ $select_column_id ?? 'x' }}--}}
        @if(  $leed->column->id != $select_column_id && !empty($select_column_id))
            <button wire:click="moveToColumn"
                    class="bg-gradient-to-tr from-blue-500 to-blue-600
text-white p-2 ml-0 rounded shadow-lg
hover:from-blue-600 hover:to-blue-700"
            >передвинуть
            </button>
        @endif
    </div>
</div>
