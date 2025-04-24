<div class="p-4 bg-gray-100 rounded-lg shadow">

    <h3 class="text-lg font-bold mb-3">Комментарии</h3>

    <form wire:submit="save">
        <input type="file" wire:model="photos" multiple>
        @error('photos.*') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Save photo</button>
    </form>

    @if(1==2)

        leed_record_id: {{ $leed_record_id ?? 'x' }}

        <form wire:submit.prevent="addComment">
            <!-- Форма добавления комментария -->
            <div class="mb-4"
                {{--             x-data="{ previews: [] }"--}}
            >
            <textarea wire:model="newComment" class="w-full p-2 border rounded"
                      placeholder="Введите комментарий..."></textarea>
                @error('newComment') <span class="text-red-500">{{ $message }}</span> @enderror


                {{--        @if(1==2)--}}
                {{--        <!-- Перетаскивание файлов с превью -->--}}
                {{--        <div--}}
                {{--            class="border-dashed border-2 p-4 mt-2 bg-white rounded cursor-pointer relative"--}}
                {{--            x-data="{ files: [], dragging: false }"--}}
                {{--            @click="$refs.fileInput.click()"--}}
                {{--            @dragover.prevent="dragging = true"--}}
                {{--            @dragleave.prevent="dragging = false"--}}
                {{--            @drop.prevent="--}}
                {{--                dragging = false;--}}
                {{--                let droppedFiles = Array.from($event.dataTransfer.files);--}}
                {{--                $wire.uploadMultiple('files', droppedFiles);--}}
                {{--                droppedFiles.forEach(file => {--}}
                {{--                    if (file.type.startsWith('image/')) {--}}
                {{--                        let reader = new FileReader();--}}
                {{--                        reader.onload = e => files.push(e.target.result);--}}
                {{--                        reader.readAsDataURL(file);--}}
                {{--                    }--}}
                {{--                });--}}
                {{--            "--}}
                {{--        >--}}
                {{--                <p x-show="!dragging" class="text-gray-500 text-center">Кликните или перетащите файлы сюда</p>--}}
                {{--                <p x-show="dragging" class="text-blue-500 text-center">Отпустите файлы для загрузки</p>--}}

                {{--                <!-- Превью загруженных изображений -->--}}
                {{--                <div class="mt-2 flex flex-wrap gap-2">--}}
                {{--                    <template x-for="file in files" :key="file">--}}
                {{--                        <img :src="file" class="w-16 h-16 object-cover rounded border">--}}
                {{--                        file--}}
                {{--                    </template>--}}
                {{--                </div>--}}
                {{--        </div>--}}

                {{--        <!-- Файловый инпут (скрытый) -->--}}
                {{--        <input type="file" x-ref="fileInput" wire:model="files" multiple class="hidden"/>--}}
                {{--        @endif--}}

                <input type="file" multiple wire:model="ffiles"
                       {{--               x-ref="fileInput"--}}
                       {{--               @change="previewFiles($event)"--}}
                       {{--                               accept="image/*"--}}
                       accept="*/*"
                />

                <!-- Превью выбранных изображений -->
                {{--            <div class="mt-2 flex flex-wrap gap-2">--}}
                {{--                <template x-for="src in previews" :key="src">--}}
                {{--                    <span x-text="src"></span>--}}
                {{--                    <img :src="src" class="w-16 h-16 object-cover rounded border"/>--}}
                {{--                </template>--}}
                {{--            </div>--}}

                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                    Добавить комментарий
                </button>

            </div>


            {{--    <script>--}}
            {{--        function previewFiles(event) {--}}
            {{--            let previews = [];--}}
            {{--            Array.from(event.target.files).forEach(file => {--}}
            {{--                if (file.type.startsWith('image/')) {--}}
            {{--                    let reader = new FileReader();--}}
            {{--                    reader.onload = e => previews.push(e.target.result);--}}
            {{--                    reader.readAsDataURL(file);--}}
            {{--                }--}}
            {{--            });--}}
            {{--            setTimeout(() => { document.querySelector('[x-data]').__x.$data.previews = previews; }, 100);--}}
            {{--        }--}}
            {{--    </script>--}}
        </form>

    @endif

</div>
