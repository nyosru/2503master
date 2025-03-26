<div>
    {{--добавили комент--}}
    @if (session()->has('message'))
        {{--        <div class="bg-green-500 text-white p-2 mb-4">--}}
        {{--            {{ session('message') }}--}}
        {{--        </div>--}}
        <script>
            document.getElementById('scrollable-block').scrollTop = document.getElementById(
                'scrollable-block').scrollHeight + 500;
        </script>
    @endif

    <form wire:submit="addComment" class="space-y-1"
          {{--          x-show="show_form"--}}
          x-data="fileUploader()"
          id="message"
          @file-selected.window="handleFiles($event.detail)"
          @open-reply-form.window="openReplyForm($event.detail)"
    >
        <div>
            @if( !empty($parentCommentId))
                <div>
                    <span> ответ на сообщение </span>
                    <button wire:click="$set('parentCommentId',null)"
                            class="text-red-300 hover:text-red-600 hover:underline"> х
                    </button>
                </div>
            @endif

            <input type="hidden"
                   wire:model="parentCommentId"
            >
            <div class="flex flex-row"
                 x-data="{ uploading: false, uploading_ok: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false; uploading_ok = true"
                 x-on:livewire-upload-cancel="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <div class="flex-1">

            <textarea id="message" wire:model="message" placeholder="Комментарий"
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      rows="2"></textarea>
                </div>
                <div class="w-[60px] text-center">
                    <img src="/icon/screpka.png" class="ml-2"/>
                </div>
                {{--            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror--}}

            </div>


            <div class="flex flex-row pb-3"

            >
                <div
                    class="w-3/4"
                >
                    {{--                <div wire:loading wire:target="fi">секундочку, загружаю файлы ...</div>--}}

                    <label class="text-sm font-medium text-gray-700 bg-blue-500">
                        {{--                    Файлы--}}
                        <input type="file" wire:model="fi"
                               multiple
                               x-ref="fileInput"
                               @change="$dispatch('file-selected', $event.target.files)"
                               class="mt-1 block w-full text-sm text-gray-500 p-3 border border-1 "/>
                    </label>
                    @error('fi.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <div x-show="uploading">
                        секундочку, загружаю файлы ...<br/>
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                    <div x-show="uploading_ok">

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


                    </div>

                </div>

                <div class="w-1/4 text-center pt-3
            ">
                    <button type="submit"
                            x-show="!uploading"
                            class="bg-blue-500 text-white px-3 py-1 rounded-md">Добавить
                    </button>
                </div>

            </div>
    </form>
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
                    let fileData = {name: file.name, url: '', icon: '', isImage: false};

                    if (file.type.startsWith('image/')) {
                        fileData.isImage = true;
                        let reader = new FileReader();
                        reader.onload = (e) => fileData.url = e.target.result;
                        reader.readAsDataURL(file);
                        this.imageFiles.push(fileData);
                    } else {
                        fileData.icon = `/public/icon/files/${fileExt}.png`;

                        // Если иконки нет, используем default
                        fetch(fileData.icon, {method: 'HEAD'}).then(response => {
                            if (!response.ok) fileData.icon = '/public/icon/files/default.png';
                        }).catch(() => fileData.icon = '/public/icon/files/default.png');

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
                )
                    ;
                } else {
                    this.clearPreview();
                }
            },

            clearPreview() {
                this.imageFiles = [];
                this.otherFiles = [];
                this.selectedFiles = [];
            @this.set('newComment', '')
                ; // Очистка комментария через Livewire
            }

        }));
    });
</script>

