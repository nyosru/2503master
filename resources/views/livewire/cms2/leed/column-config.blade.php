<div>

    <button
        class="text-blue-500 hover:text-blue-700 focus:outline-none"
        wire:click="openModal({{ $column->id }})"
    >
        ⚙️
    </button>

    @if ($modal_show)
        @teleport('body')
        <!-- Всплывающее окно -->
        {{--        <div class="bg-black/50 flex items-center justify-center" style="z-index: 100; margin: 0; position: fixed; top: 0; bottom: 0; left: 0; right: 0;">--}}
        {{--            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 md:w-1/3">--}}
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 md:w-1/3">
                <h2 class="text-lg font-bold mb-4">Настройки столбца</h2>
                <form wire:submit.prevent="saveColumnConfig">

                    <div class="flex flex-col space-x-3 text-sm font-medium">

                        <div class="flex flex-row mb-2 space-x-2">

                            <div class="w-1/4">
                                    Название:
                            </div>
                                    <div class="w-3/4">
                                    <input type="text" wire:model="settings.name" class="w-full"/>
                            </div>
                        </div>


                        @foreach ($settings as $key => $value)
                            <div class="flex flex-row mb-2 space-x-2">
                                <div class="w-3/4 text-right">
                                    {{ $named[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}:
                                </div>
                                <div class="w-1/4">
                                    <input type="checkbox" wire:model="settings.{{ $key }}"
                                           @if($value) checked @endif />
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Сообщение об ошибке -->
                    @if (session()->has('error'))
                        <span class="bg-red-100 text-red-800 p-2 rounded mb-4">
                            {{ session('error') }}
                        </span>
                    @endif

                    <div class="text-center mt-4">
                        <button type="button" wire:click="$set('modal_show', false)"
                                class="bg-gray-500 text-white py-1 px-4 rounded mr-2">
                            Закрыть
                        </button>
                        <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded">
                            Сохранить
                        </button>
                    </div>

                </form>
            </div>
        </div>
        @endteleport
    @endif
</div>
