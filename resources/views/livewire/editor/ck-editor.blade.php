<div>
    <form wire:submit="save">
        <!-- Заголовок -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Заголовок</label>
            <input type="text" wire:model="title"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Редактор CKEditor -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Контент</label>
            <div id="editor"></div>
            <textarea wire:model="htmlContent" id="htmlContent" class="hidden"></textarea>
            @error('htmlContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Кнопка сохранения -->
        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
            Сохранить
        </button>

        @if(session()->has('message'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
    </form>

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            let editor;

            // Инициализация редактора
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    initialData: @this.htmlContent || '',
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
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
                    if (@this.htmlContent) {
                        editor.setData(@this.htmlContent);
                    }

                    // Обновление Livewire при изменении контента
                    editor.model.document.on('change:data', () => {
                    @this.set('htmlContent', editor.getData());
                    });
                })
                .catch(error => {
                    console.error('Ошибка CKEditor:', error);
                });

            // Очистка при размонтировании
            Livewire.on('destroy', () => {
                if (editor) {
                    editor.destroy().catch(error => {
                        console.error('Ошибка при уничтожении редактора:', error);
                    });
                }
            });
        });
    </script>
    @endscript
</div>
