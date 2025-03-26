<div class="p-4 bg-gray-100 rounded-lg shadow"
     x-data="fileUploader()"
     @file-selected.window="handleFiles($event.detail)"
>
    <h3 class="text-lg font-bold mb-3">Комментарии</h3>

    <p>leed_record_id: {{ $leed_record_id ?? 'x' }}</p>

    <!-- Форма добавления комментария -->
    <div class="mb-4">
        <textarea wire:model="newComment" class="w-full p-2 border rounded"
                  placeholder="Введите комментарий..."></textarea>
        @error('newComment') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Файловый инпут -->
        <input type="file" multiple
               x-ref="fileInput"
               @change="$dispatch('file-selected', $event.target.files)"
               class="hidden"/>

        <div class="border-dashed border-2 p-4 mt-2 bg-white rounded cursor-pointer"
             @click="$refs.fileInput.click()">
            <p class="text-gray-500 text-center">Кликните или перетащите файлы сюда</p>
        </div>

        <!-- Превью загруженных изображений -->
        <div class="mt-2 flex flex-wrap gap-2">
            <template x-for="file in imageFiles" :key="file.name">
                <div class="flex items-center gap-2 p-2 border rounded">
                    <img :src="file.url" class="w-16 h-16 object-cover rounded border"/>
                </div>
            </template>
        </div>

        <!-- Превью загруженных файлов (иконки) -->
        <div class="mt-2 flex flex-wrap gap-2">
            <template x-for="file in otherFiles" :key="file.name">
                <div class="flex items-center gap-2 p-2 border rounded">
                    <img :src="file.icon" class="w-8 h-8 object-cover rounded border"/>
                    <span class="text-sm text-gray-700" x-text="file.name"></span>
                </div>
            </template>
        </div>

        <button wire:click="addComment" @click="uploadFiles"
                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
            Добавить комментарий
        </button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fileUploader', () => ({
            imageFiles: [],
            otherFiles: [],
            selectedFiles: [], // Храним файлы для Livewire

            handleFiles(fileList) {
                this.imageFiles = [];
                this.otherFiles = [];
                this.selectedFiles = Array.from(fileList);

                this.selectedFiles.forEach(file => {
                    let fileExt = file.name.split('.').pop().toLowerCase();
                    let fileData = { name: file.name, url: '', icon: '', isImage: false };

                    if (file.type.startsWith('image/')) {
                        fileData.isImage = true;
                        let reader = new FileReader();
                        reader.onload = (e) => fileData.url = e.target.result;
                        reader.readAsDataURL(file);
                        this.imageFiles.push(fileData);
                    } else {
                        fileData.icon = `/public/icon/files/${fileExt}.png`;

                        // Если иконки нет, используем default
                        fetch(fileData.icon, { method: 'HEAD' })
                        .then(response => {
                            if (!response.ok) fileData.icon = '/public/icon/files/default.png';
                        })
                        .catch(() => fileData.icon = '/public/icon/files/default.png');

                        this.otherFiles.push(fileData);
                    }
                });
            },

            uploadFiles() {
                if (this.selectedFiles.length > 0) {
                @this.uploadMultiple('files', this.selectedFiles,
                    () => {
                        this.clearPreview(); // Очищаем превью после успешной загрузки
                    },
                    (error) => console.error(error)
                );
                } else {
                    this.clearPreview();
                }
            },

            clearPreview() {
                this.imageFiles = [];
                this.otherFiles = [];
                this.selectedFiles = [];
            @this.set('newComment', ''); // Очистка комментария через Livewire
            }
        }));
    });
</script>
