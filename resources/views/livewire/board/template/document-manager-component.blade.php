<div class="p-4 space-y-6">
    {{--    <div>--}}
    {{--        @if (session()->has('success'))--}}
    {{--            <div class="p-2 mb-3 text-green-700 bg-green-100 rounded">--}}
    {{--                {{ session('success') }}--}}
    {{--            </div>--}}
    {{--        @endif--}}

    {{--        <form wire:submit.prevent="saveContent" class="space-y-4">--}}
    {{--            <textarea id="editor22" wire:model.defer="content" wire:ignore ></textarea>--}}
    {{--            <br/>--}}
    {{--            <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded">Сохранить документ</button>--}}
    {{--        </form>--}}

    {{--        @if ($filePath)--}}
    {{--            <div class="mt-4">--}}
    {{--                <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="text-blue-600 underline">--}}
    {{--                    Открыть документ--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        @endif--}}
    {{--    </div>--}}


    <div class="p-4 space-y-6">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('message') }}
            </div>
        @endif

        {{-- Форма загрузки --}}
        <form wire:submit.prevent="save" class="space-y-3">
            <div>
                <label class="block text-sm font-medium mb-1">Название</label>
                <input type="text" wire:model="name" class="border rounded w-full p-2">
                @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Файл RTF</label>
                <input type="file" wire:model="file" class="block">
                @error('file')
                <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Загрузить
            </button>
        </form>

        {{-- Список шаблонов --}}
        <div class="mt-6">
            <h2 class="font-bold text-lg mb-3">Сохранённые шаблоны</h2>
            <ul class="space-y-2">
                @foreach($templates as $template)
                    <li class="border rounded p-2 flex justify-between items-center">
                        <span>{{ $template->name }}</span>
                        <div class="space-x-2">
                            <a href="{{ Storage::url($template->file_path) }}"
                               target="_blank"
                               class="px-2 py-1 bg-green-600 text-white rounded">
                                Скачать RTF
                            </a>
                            <button wire:click="delete({{ $template->id }})"
                                    class="px-2 py-1 bg-red-600 text-white rounded">
                                Удалить
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div>
        <form wire:submit.prevent="saveContent">

            {{--            <div wire:ignore>--}}
            {{--                <textarea id="myeditorinstance" wire:model.defer="content" ></textarea>--}}
            {{--            </div>--}}

            {{--            <div wire:ignore>--}}
            {{--                <textarea id="tinymce-editor" wire:model="content"></textarea>--}}
            {{--            </div>--}}

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Сохранить</button>

        </form>

        @if($filePath)
            <a href="{{ asset('storage/' . $filePath) }}" target="_blank">Открыть документ</a>
        @endif
    </div>


{{--    <div wire:ignore>--}}
{{--        <textarea id="editor" wire:model.defer="content" :key="'ddd'"></textarea>--}}
{{--    </div>--}}

    <form wire:submit.prevent="saveContent">

        <div>
            <label class="block mb-1 font-medium">Содержимое</label>
            <textarea id="editor" wire:model.defer="content"></textarea>
{{--            <textarea id="editor" wire:model.defer="content"></textarea>--}}
            @error('content') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded">Сохранить документ</button>
    </form>

</div>



@push('scripts')
    <script type="module">
        document.addEventListener('livewire:load', function () {
            const editor = new Jodit('#editor', {
                height: 300,
                toolbarSticky: true,
                toolbarButtonSize: 'middle',
                buttons: 'bold,italic,underline,|,ul,ol,|,table,|,fontsize,paragraph,align,|,undo,redo,|,source',
            });

            editor.events.on('change', function () {
            @this.set('content', editor.value);
            });
        });
    </script>
@endpush


@push('scripts')
{{--    <link rel="stylesheet" href="{{ asset('js/jodit/jodit.min.css') }}">22--}}
{{--    <script src="{{ asset('js/jodit/jodit.min.js') }}"></script>--}}

{{--<link rel="stylesheet" href="{{ mix('css/jodit.css') }}">--}}
{{--<script src="{{ mix('js/jodit.js') }}"></script>--}}

    <script>
        document.addEventListener('livewire:load', function () {
            const editor = new Jodit('#editor', {
                height: 300,
                toolbarSticky: true,
                toolbarButtonSize: 'middle',
                buttons: 'bold,italic,underline,|,ul,ol,|,table,|,fontsize,paragraph,align,|,undo,redo,|,source',
            });

            editor.events.on('change', function () {
            @this.set('content', editor.value);
            });
        });
    </script>
@endpush

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        // document.addEventListener('livewire:load', function () {--}}
{{--        //     window.initTinyMCE('#editor');--}}
{{--        // });--}}
{{--        //--}}
{{--        // Livewire.on('contentUpdated', content => {--}}
{{--        //     if (tinymce.get('editor')) {--}}
{{--        //         tinymce.get('editor').setContent(content);--}}
{{--        //     }--}}
{{--        // });--}}
{{--        //--}}
{{--        // Livewire.hook('message.processed', (message, component) => {--}}
{{--        //     if (!tinymce.get('editor')) {--}}
{{--        //         window.initTinyMCE('#editor');--}}
{{--        //     }--}}
{{--        // });--}}

{{--        document.addEventListener('livewire:load', function () {--}}
{{--            tinymce.init({--}}
{{--                selector: '#editor',  // ID твоего textarea--}}
{{--                height: 400,--}}
{{--                plugins: 'table lists advlist code',--}}
{{--                toolbar: 'undo redo | bold italic underline | fontsizeselect | alignleft aligncenter alignright alignjustify | table | bullist numlist | code',--}}
{{--                setup: function (editor) {--}}
{{--                    editor.on('Change KeyUp', function () {--}}
{{--                        // Обновляем Livewire свойство--}}
{{--                        Livewire.emit('updateContent', editor.getContent());--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}


{{--    </script>--}}
{{--@endpush--}}





{{--<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>--}}
{{--@push('scripts')--}}

{{--    --}}{{--        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>--}}
{{--    --}}{{--        <script>--}}
{{--    --}}{{--            document.addEventListener('livewire:load', function () {--}}
{{--    --}}{{--                tinymce.init({--}}
{{--    --}}{{--                    selector: '#editor',--}}
{{--    --}}{{--                    height: 400,--}}
{{--    --}}{{--                    plugins: 'table lists advlist code',--}}
{{--    --}}{{--                    toolbar: 'undo redo | bold italic underline | fontsizeselect | alignleft aligncenter alignright alignjustify | table | bullist numlist | code',--}}
{{--    --}}{{--                    setup: function (editor) {--}}
{{--    --}}{{--                        editor.on('Change KeyUp', function () {--}}
{{--    --}}{{--                        @this.set('content', editor.getContent());--}}
{{--    --}}{{--                        });--}}
{{--    --}}{{--                    }--}}
{{--    --}}{{--                });--}}
{{--    --}}{{--            });--}}
{{--    --}}{{--        </script>--}}

{{--    --}}{{--        <script>--}}
{{--    --}}{{--            document.addEventListener('livewire:load', function () {--}}

{{--    --}}{{--                tinymce.init({--}}
{{--    --}}{{--                    selector: '#editor',--}}
{{--    --}}{{--                    setup: function (editor) {--}}
{{--    --}}{{--                        editor.on('Change KeyUp', function () {--}}
{{--    --}}{{--                        @this.set('content', editor.getContent());--}}
{{--    --}}{{--                        });--}}
{{--    --}}{{--                    }--}}
{{--    --}}{{--                });--}}

{{--    --}}{{--                Livewire.hook('message.processed', (message, component) => {--}}
{{--    --}}{{--                    if (!tinymce.get('editor')) {--}}
{{--    --}}{{--                        tinymce.init({--}}
{{--    --}}{{--                            selector: 'textarea#editor',--}}
{{--    --}}{{--                            setup: function (editor) {--}}
{{--    --}}{{--                                editor.on('Change KeyUp', function () {--}}
{{--    --}}{{--                                    window.livewire.find(component.id).set('content', editor.getContent());--}}
{{--    --}}{{--                                });--}}
{{--    --}}{{--                            }--}}
{{--    --}}{{--                        });--}}
{{--    --}}{{--                    }--}}
{{--    --}}{{--                });--}}

{{--    --}}{{--            });--}}
{{--    --}}{{--        </script>--}}




{{--    --}}{{--@push('scripts')--}}
{{--    --}}{{--    <script>--}}
{{--    --}}{{--        document.addEventListener("livewire:load", () => {--}}
{{--    --}}{{--            tinymce.init({--}}
{{--    --}}{{--                selector: '#myeditorinstance',--}}
{{--    --}}{{--                plugins: 'code table lists',--}}
{{--    --}}{{--                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'--}}
{{--    --}}{{--            });--}}
{{--    --}}{{--        });--}}
{{--    --}}{{--        window.addEventListener('contentChanged', () => {--}}
{{--    --}}{{--            if (!tinymce.get('myeditorinstance')) {--}}
{{--    --}}{{--                tinymce.init({ selector:'#myeditorinstance' });--}}
{{--    --}}{{--            }--}}
{{--    --}}{{--        });--}}
{{--    --}}{{--    </script>--}}
{{--    --}}{{--@endpush--}}






{{--    --}}{{--    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>--}}
{{--    --}}{{--    <script>--}}
{{--    --}}{{--        window.addEventListener('init-tinymce', () => {--}}
{{--    --}}{{--            tinymce.init({--}}
{{--    --}}{{--                selector: '#tinymce-editor',--}}
{{--    --}}{{--                plugins: 'code lists',--}}
{{--    --}}{{--                toolbar: 'undo redo | bold italic | bullist numlist | code',--}}
{{--    --}}{{--                setup: function (editor) {--}}
{{--    --}}{{--                    editor.on('Change KeyUp', function () {--}}
{{--    --}}{{--                    @this.set('content', editor.getContent())--}}
{{--    --}}{{--                        ;--}}
{{--    --}}{{--                    });--}}
{{--    --}}{{--                }--}}
{{--    --}}{{--            });--}}
{{--    --}}{{--        });--}}

{{--    --}}{{--        // Для редких случаев, если компонент Livewire перерисовывается — и снова нужен редактор--}}
{{--    --}}{{--        document.addEventListener('livewire:load', function () {--}}
{{--    --}}{{--            tinymce.remove('#tinymce-editor');--}}
{{--    --}}{{--            tinymce.init({--}}
{{--    --}}{{--                selector: '#tinymce-editor',--}}
{{--    --}}{{--                plugins: 'code lists',--}}
{{--    --}}{{--                toolbar: 'undo redo | bold italic | bullist numlist | code',--}}
{{--    --}}{{--                setup: function (editor) {--}}
{{--    --}}{{--                    editor.on('Change KeyUp', function () {--}}
{{--    --}}{{--                    @this.set('content', editor.getContent())--}}
{{--    --}}{{--                        ;--}}
{{--    --}}{{--                    });--}}
{{--    --}}{{--                }--}}
{{--    --}}{{--            });--}}
{{--    --}}{{--        });--}}
{{--    --}}{{--    </script>--}}

{{--@endpush--}}
