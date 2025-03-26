<div class="p-4 bg-gray-100 rounded-lg shadow">

    <livewire:cms2.leed.comment-add :leed_record_id="$leed_record_id" />

@if(1 ==2)
    <!-- Форма добавления комментария -->
    {{--    <div class="mb-4">--}}
    <div class="p-4 bg-gray-100 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-3">Комментарии</h3>

        <!-- Форма добавления комментария -->
        <div class="mb-4">
            <textarea wire:model="newComment" class="w-full p-2 border rounded"
                      placeholder="Введите комментарий..."></textarea>
            @error('newComment') <span class="text-red-500">{{ $message }}</span> @enderror

            <!-- Перетаскивание файлов с превью -->
            <div
                class="border-dashed border-2 p-4 mt-2 bg-white rounded cursor-pointer relative"
                x-data="{ files: [], dragging: false }"
                @click="$refs.fileInput.click()"
                @dragover.prevent="dragging = true"
                @dragleave.prevent="dragging = false"
                @drop.prevent="
                dragging = false;
                let droppedFiles = Array.from($event.dataTransfer.files);
                $wire.uploadMultiple('files', droppedFiles);
                droppedFiles.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        let reader = new FileReader();
                        reader.onload = e => files.push(e.target.result);
                        reader.readAsDataURL(file);
                    }
                });
            "
            >
                <p x-show="!dragging" class="text-gray-500 text-center">Кликните или перетащите файлы сюда</p>
                <p x-show="dragging" class="text-blue-500 text-center">Отпустите файлы для загрузки</p>

                <!-- Превью загруженных изображений -->
                <div class="mt-2 flex flex-wrap gap-2">
                    <template x-for="file in files" :key="file">
                        <img :src="file" class="w-16 h-16 object-cover rounded border">
                    </template>
                </div>
            </div>

            <!-- Файловый инпут (скрытый) -->
            <input type="file" x-ref="fileInput" wire:model="files" multiple class="hidden"/>

            <button wire:click="addComment" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                Добавить комментарий
            </button>
        </div>
    </div>
@endif



    <!-- Список комментариев -->
    <ul class="space-y-3">
        @foreach($comments as $comment)
            <li class="p-3 bg-white border rounded shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">
                            <strong>{{ $comment->user->name }}</strong>
                            <span class="text-xs text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="mt-1">{{ $comment->comment }}</p>

                        <!-- Файлы комментария -->
                        @if ($comment->files->isNotEmpty())
                            <div class="mt-2">
                                <p class="text-gray-700 font-semibold">Файлы:</p>
                                <ul class="list-disc list-inside text-blue-500">
                                    @foreach ($comment->files as $file)
                                        <li>
                                            @if (Str::startsWith($file->file_path, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <img src="{{ asset('storage/' . $file->path) }}"
                                                     class="w-16 h-16 object-cover rounded border">
                                            @else
                                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank">
                                                    {{ $file->file_name }}
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    @permission('разработка')
                    <button wire:click="deleteComment({{ $comment->id }})"
                            class="text-red-500 text-sm">
                        Удалить
                    </button>
                    @endpermission
                </div>
            </li>
        @endforeach
    </ul>

</div>
