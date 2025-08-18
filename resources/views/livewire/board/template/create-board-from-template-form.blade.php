<div x-data="{ showForm: false }">

    <center>
        <button
            @click="showForm = !showForm"
            {{--                        wire:click="createBoardFromShablon({{ $shablon->id }})"--}}
            {{--                        wire:confirm="Создать доску ?"--}}
            class="bg-gradient-to-br from-orange-300 to-orange-400 rounded-lg px-2 py-0
                        w-1/2
                        btn btn-sm btn-outline-primary">
            Создать
        </button>
    </center>

    <div x-show="showForm" class="m-4 p-4 bg-white border rounded-md shadow">
        <form

            wire:submit="createBoardFromShablon({{ $template_id }})">
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


    </div>
</div>
