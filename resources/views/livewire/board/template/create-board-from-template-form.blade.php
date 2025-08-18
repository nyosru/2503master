<form wire:submit="createBoardFromShablon({{ $template_id }})">
    <h2 class="text-lg font-bold">Создание доски по шаблону</h2>

    <input
        {{--                            x-model="newBoardName"--}}
        type="text"
        wire:model="board_name"
        placeholder="Введите название новой доски"
        class="border rounded px-2 py-1 w-full mb-2"
    />

    <div class="flex space-x-2">
        <button
            type="submit"
            {{--                                @click="submitNewBoard({{ $shablon->id }})"--}}
            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
        >
            Создать
        </button>

        {{--                            <button--}}
        {{--                                @click="showForm = false"--}}
        {{--                                class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400"--}}
        {{--                            >--}}
        {{--                                Отмена--}}
        {{--                            </button>--}}
    </div>
</form>
