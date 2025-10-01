{{-- resources/views/livewire/board/template/jodit-component.blade.php --}}
<div class="p-4 space-y-4">

    @if (session()->has('success'))
        <div class="p-2 mb-3 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="saveTemplate" class="space-y-3">
        <div>
            <label class="block text-sm font-medium mb-1">Название шаблона</label>
            <input type="text" wire:model.defer="name" class="border rounded w-full p-2">
            @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div >
            <label class="block text-sm font-medium mb-1">Контент шаблона</label>
            <textarea id="editor" wire:model.defer="content"></textarea>
            @error('content') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded">
            {{ $editingTemplateId ? 'Сохранить изменения' : 'Добавить шаблон' }}
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
                        <button wire:click="editTemplate({{ $template->id }})"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">
                            Редактировать
                        </button>
                        <button wire:click="deleteTemplate({{ $template->id }})"
                                class="px-2 py-1 bg-red-600 text-white rounded">
                            Удалить
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>


        @push('scripts')
            <script>
                document.addEventListener('livewire:load', function () {
                    const editor = new window.Jodit('#editor', {
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

</div>
