<div>

    @if(session('error_all'))
        <div class="bg-gradient-to-tr to-red-100 from-red-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('error_all') }}
        </div>
    @else


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

    текущий шаг: {{ $leed->column->name ?? 'x'}}
    <br/>
    <select wire:model.live="select_column_id" class="min-w-[300px] mr-0">
        @foreach ($columns as $column)
            <option
                :key="'opt'.$column->id"
                value="{{ $column->id }}">{{ $column->name }} {{ $leed->column->id == $column->id ? '(текущий)' : '' }}</option>
        @endforeach
    </select>
    @if(  $leed->column->id != $select_column_id )
        <button wire:click="moveToColumn"
                class="bg-gradient-to-tr from-blue-500 to-blue-600
text-white p-2 ml-0 rounded shadow-lg
hover:from-blue-600 hover:to-blue-700"
        >передвинуть
        </button>
    @endif
    <div class="flex flex-col  text-center">
        <div>
            Добавить комментарий:
        </div>
        <div>
        <textarea
            class="max-w-[300px] w-full"
            wire:model="comment_now"
        ></textarea>
        </div>
        <div>
            <button wire:click="addComment"
                    class="bg-gradient-to-tr from-blue-500 to-blue-600
        text-white p-2 ml-0 rounded shadow-lg
        hover:from-blue-600 hover:to-blue-700"
            >передвинуть
            </button>
        </div>
    </div>

    @endif

</div>
