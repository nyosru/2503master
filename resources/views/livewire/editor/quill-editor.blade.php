<div>
    <form wire:submit="save">
        <!-- Заголовок -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Заголовок</label>
            <input type="text" wire:model="title"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Редактор Quill -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Контент</label>
            <div id="editor-{{ $this->id }}" style="height: 400px;" class="border rounded-md"></div>
            <textarea wire:model="htmlContent" id="htmlContent-{{ $this->id }}" class="hidden"></textarea>
            @error('htmlContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Загрузка изображений -->
        <div class="mb-4 p-4 border rounded bg-gray-50">
            <label class="block text-sm font-medium text-gray-700 mb-2">Загрузить изображение</label>
            <div class="flex gap-2">
                <input type="file" wire:model="image" accept="image/*" class="flex-1">
                <button type="button" wire:click="uploadImage"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Загрузить
                </button>
            </div>
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
            const editorId = 'editor-{{ $this->id }}';
            const textareaId = 'htmlContent-{{ $this->id }}';

            // Инициализация Quill редактора
            const quill = new Quill(`#${editorId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                },
                placeholder: 'Начните писать ваш контент...'
            });

            // Установка начального контента
            if (@this.htmlContent) {
                quill.root.innerHTML = @this.htmlContent;
            }

            // Обновление Livewire при изменении контента
            quill.on('text-change', function() {
            @this.set('htmlContent', quill.root.innerHTML);
            });

            // Обработка вставки изображений через toolbar
            const toolbar = quill.getModule('toolbar');
            toolbar.addHandler('image', function() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    const file = this.files[0];
                    if (file) {
                        // Загружаем через Livewire
                    @this.upload('image', file, () => {
                    @this.call('uploadImage').then(() => {
                        // Вставляем изображение в редактор после загрузки
                        Livewire.on('image-uploaded', (event) => {
                            const range = quill.getSelection(true);
                            quill.insertEmbed(range.index, 'image', event.url);
                        });
                    });
                    });
                    }
                };

                input.click();
            });

            // Очистка при размонтировании компонента
            Livewire.on('destroy', () => {
                if (quill) {
                    quill.off('text-change');
                    const container = quill.container;
                    if (container && container.parentNode) {
                        container.parentNode.removeChild(container);
                    }
                }
            });
        });
    </script>
    @endscript
</div>
