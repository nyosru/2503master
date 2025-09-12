<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Создание новой записи</h2>

        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Заменяем простой textarea на это: -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Контент *</label>
            <textarea wire:model="content" data-ckeditor
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 hidden"
                      placeholder="Начните писать ваш контент здесь..."></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

    </div>

        @if(1==2)
        <form wire:submit="save">
            <!-- Заголовок -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Заголовок *</label>
                <input type="text" wire:model="title"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">URL (slug)</label>
                <input type="text" wire:model="slug"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Краткое описание -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Краткое описание</label>
                <textarea wire:model="excerpt" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Краткое описание записи..."></textarea>
                @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Основной контент -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Контент *</label>
                <div id="editor-create"></div>
                <textarea wire:model="content" id="content-create" class="hidden"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Изображение -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Главное изображение</label>
                <input type="file" wire:model="featured_image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if($featured_image)
                    <div class="mt-2">
                        <img src="{{ $featured_image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
            </div>

            <!-- Теги -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Теги</label>
                <input type="text" wire:model="tags"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="тег1, тег2, тег3">
                @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Публикация -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="is_published" class="rounded border-gray-300 text-blue-600">
                    <span class="ml-2 text-sm text-gray-700">Опубликовать сразу</span>
                </label>
            </div>

            <!-- Кнопки -->
            <div class="flex gap-4">
                <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Создать запись
                </button>

                <button type="button" wire:click="$set('is_published', false)"
                        class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">
                    Сохранить черновик
                </button>
            </div>
        </form>
    </div>

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            let editor;

            // Инициализация CKEditor
            ClassicEditor
                .create(document.querySelector('#editor-create'), {
                    initialData: @this.content || '',
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'link', 'bulletedList', 'numberedList', '|',
                            'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'undo', 'redo'
                        ]
                    },
                    simpleUpload: {
                        uploadUrl: '{{ route("editor.upload") }}',
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }
                })
                .then(newEditor => {
                    editor = newEditor;

                    // Установка начального контента
                    if (@this.content) {
                        editor.setData(@this.content);
                    }

                    // Обновление Livewire при изменении контента
                    editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData());
                    });
                })
                .catch(error => {
                    console.error('Ошибка инициализации CKEditor:', error);
                });

            // Очистка при размонтировании
            Livewire.on('destroy', () => {
                if (editor) {
                    editor.destroy().catch(error => {
                        console.error('Ошибка при уничтожении редактора:', error);
                    });
                }
            });

            // Обработка события создания записи
            Livewire.on('post-created', (event) => {
                // Можно добавить редирект или другие действия
                console.log('Запись создана с ID:', event.postId);

                // Очистка редактора
                if (editor) {
                    editor.setData('');
                }
            });
        });
    </script>
    @endscript
    @endif
</div>
