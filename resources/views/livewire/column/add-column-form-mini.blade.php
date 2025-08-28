<span x-data="{ showModal: @entangle('showModal') }">
    <button
        class="text-green-500 hover:text-green-700"
{{--        wire:click="showAddForm('{{ $column_id }}')"--}}
@click="showModal = true"
        title="Добавить новый столбец справа"
{{--        wire:key="add_col_{{ $column_id }}"--}}
    >+</button>

{{--    <button--}}
{{--        @click="showModal = true"--}}
{{--        class="text-blue-600"--}}
{{--    >Добавить столбец</button>--}}
 @teleport('body')
    <div
        x-show="showModal"
        x-transition
        class="fixed inset-0 z-150 flex items-center justify-center bg-gray-800 bg-opacity-75"
        style="display: none;"
    >
        <div class="bg-white rounded-xl p-1 max-w-md w-full shadow-lg relative" @click.away="showModal = false">

            <div class="xmy-1 p-1 text-center rounded-xl bg-blue-200">

                <button
                    class="xabsolute xtop-2 xright-2 mr-2 float-right text-blue-600 text-md"
                    @click="showModal = false"
                    title="Скрыть формы"
                >
                    x
                </button>

                <b>Добавить столбец справа</b>

                <form
                    class="block mt-4"
                    wire:submit.prevent="addColumn('{{ $column_id }}')"
                >
                    <input
                        class="w-full mb-3 border rounded p-2"
                        wire:model.defer="addColumnName"
                        type="text"
                        name="addColumnName"
                        placeholder="Название столбца"
                        required
                    />

                    <div class="text-left mb-3">
                        Показывать столбец должностям:
                        @foreach($roles as $role)
                            <label class="block">
                                <input type="checkbox" wire:model="select_roles" value="{{ $role->id }}">
                                {{ $role->name_ru }}
                            </label>
                        @endforeach
                    </div>

                    <input
                        class="bg-blue-300 active:bg-blue-400 rounded px-4 py-2 cursor-pointer"
                        type="submit"
                        value="Добавить"
                    />
                </form>

            </div>

        </div>
    </div>
     @endteleport
</span>
