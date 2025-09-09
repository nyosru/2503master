<div>
    <!-- Заголовок и кнопка создания -->
    <div class="p-6 bg-white shadow-sm border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Управление доменами</h2>

            <button wire:click="startCreate"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Добавить домен
            </button>
        </div>
    </div>

    <!-- Поиск и сортировка -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Поиск по доменам..."
                       class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex gap-2">
                <select wire:model.live="sortField" class="flex-1 p-2 border border-gray-300 rounded-lg">
                    <option value="domain">Домен</option>
                    <option value="domain_ru">Название</option>
                    <option value="created_at">Дата создания</option>
                </select>
                <button wire:click="sortDirection = '{{ $sortDirection === 'asc' ? 'desc' : 'asc' }}'"
                        class="px-3 py-2 border border-gray-300 rounded-lg">
                    {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Таблица доменов -->
    <div class="bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Домен</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Администратор</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Досок</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата создания</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($domains as $domain)
                    <tr wire:key="domain-{{ $domain->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $domain->domain }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $domain->domain_ru }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">
                                    {{ $domain->adminUser->name }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                    {{ $domain->boards_count }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $domain->created_at->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button wire:click="startEdit({{ $domain->id }})"
                                        class="text-blue-600 hover:text-blue-900">Редактировать</button>
                                <button wire:click="deleteDomain({{ $domain->id }})"
                                        onclick="return confirm('Удалить домен?')"
                                        class="text-red-600 hover:text-red-900">Удалить</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            Домены не найдены
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="px-6 py-4 bg-white border-t border-gray-200">
            {{ $domains->links() }}
        </div>
    </div>

    <!-- Модальное окно формы -->
    <x-modal name="domain-form" maxWidth="lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">
                {{ $isEditing ? 'Редактирование домена' : 'Создание домена' }}
            </h3>

            <form wire:submit.prevent="saveDomain">
                <div class="space-y-4">
                    <!-- Домен -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Домен *</label>
                        <input type="text" wire:model="domain"
                               class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                        @error('domain') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Русское название -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Название *</label>
                        <input type="text" wire:model="domain_ru"
                               class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                        @error('domain_ru') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Администратор -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Администратор *</label>
                        <select wire:model="admin_user_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2">
                            <option value="">Выберите администратора</option>
                            @foreach($adminUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('admin_user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" wire:click="$dispatch('close-modal', 'domain-form')"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Отмена
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ $isEditing ? 'Обновить' : 'Создать' }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Flash сообщения -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
