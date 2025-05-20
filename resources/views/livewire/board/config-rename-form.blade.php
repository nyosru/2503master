<div class="w-[250px] p-4 bg-white rounded-lg shadow" x-data="{ showSaveButton: false }">
    @if(session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">

        <input type="text"
               placeholder="Название"
               wire:model="name"
               @click="showSaveButton = true"
               class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
        @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

        <input wire:model="description"
               @click="showSaveButton = true"
               placeholder="Описание"
               class="w-full p-2 border rounded"
        >

        <button type="submit"
                x-show="showSaveButton"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Сохранить изменения
        </button>
    </form>


    {{--    <div x-data="{ showSaveButton: false }">--}}
    {{--        $board_id;--}}
    {{--        {{$board_id}}<Br/>--}}
    {{--        $field_id--}}
    {{--        {{$field_id}}--}}
    {{--        <br/>--}}

    {{--        <form wire:submit="save">--}}
    {{--            <input type="text"--}}
    {{--                   --}}{{--               name="name" --}}
    {{--                   wire:model="name"--}}
    {{--                   placeholder="название" title="название" @click="showSaveButton = true"/>--}}
    {{--            <br/>--}}
    {{--            <input type="text"--}}
    {{--                   --}}{{--               name="description"--}}
    {{--                   wire:model="description"--}}
    {{--                   placeholder="описание" title="описание" @click="showSaveButton = true"/>--}}
    {{--            <Br/>--}}
    {{--            <button type="submit"--}}
    {{--                    class="bg-blue-400 px-2 py-1 rounded"--}}
    {{--                    x-show="showSaveButton">Сохранить--}}
    {{--            </button>--}}
    {{--        </form>--}}

    {{--    </div>--}}

</div>
