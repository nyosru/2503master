<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Персональные настройки доски</h3>

    @if(session('successSave'))
    <div class="bg-green-500 text-white p-4 rounded mb-4 shadow-lg">
        {{ session('successSave') }}
    </div>
@endif



    <form wire:submit.prevent="saveSettings">


        <!-- Карточек на странице -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $this->getLabel('name') }}:
            </label>

            <input type="text" wire:model="settings.name"
                   min="5" max="100"
                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">

            @error('settings.name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $this->getLabel('view') }}:
            </label>

            <select wire:model="settings.view"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                @foreach($this->getOptions('view') as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>

            @error('settings.view')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


    @if(1==2)

            <!-- Режим отображения -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $this->getLabel('view_type') }}:
                </label>

                <select wire:model="settings.view_type"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @foreach($this->getOptions('view_type') as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>

                @error('settings.view_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Режим отображения -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $this->getLabel('domain') }}:
                </label>

                <select wire:model="settings.domain_id"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">выберите</option>
                    @foreach($this->settingOptions['domain'] as $v)
                        {{--                @foreach($this->getOptions('domain') as $v)--}}
                        <option value="{{ $v->id }}">{{ $v->domain_ru ?? $v->domain ?? '??' }}</option>
                    @endforeach
                </select>

                @error('settings.domain')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Карточек на странице -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $this->getLabel('cards_per_page') }}:
                </label>

                <input type="number" wire:model="settings.cards_per_page"
                       min="5" max="100"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">

                @error('settings.cards_per_page')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Чекбоксы -->
            <div class="space-y-3 mb-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="settings.show_avatars"
                           class="mr-2 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">{{ $this->getLabel('show_avatars') }}</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" wire:model="settings.compact_mode"
                           class="mr-2 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">{{ $this->getLabel('compact_mode') }}</span>
                </label>
            </div>

            <!-- Сообщения об успехе -->
            @if (session()->has('userSettingsSuccess'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('userSettingsSuccess') }}
                </div>
            @endif
        @endif

        <div class="flex space-x-3">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Сохранить настройки
            </button>

            <button type="button" wire:click="resetToDefault"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400
                           focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Сбросить
            </button>
        </div>
    </form>

    @if(1==2)
        <!-- Текущие настройки -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-medium text-gray-700 mb-2">Текущие настройки:</h4>
            <div class="space-y-1 text-sm text-gray-600">
                @foreach($settings as $key => $value)
                    <div class="flex justify-between">
                        <span>{{ $this->getLabel($key) }}:</span>
                        <strong class="text-blue-600">
                            @if(is_bool($value))
                                {{ $value ? 'Да' : 'Нет' }}
                            @else
                                {{ $value }}
                            @endif
                        </strong>
                    </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Эти настройки применяются только к вашей учетной записи.
            </p>
        </div>
    @endif
</div>
