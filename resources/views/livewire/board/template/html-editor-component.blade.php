<div x-data="editor()" class="p-4 space-y-4">

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

        <div>
            <label class="block text-sm font-medium mb-1">Редактор</label>

            <!-- Панель инструментов -->
            <div class="flex flex-wrap space-x-2 mb-2">
                <button type="button" @click="exec('bold')" class="px-2 py-1 border rounded font-bold">B</button>
                <button type="button" @click="exec('italic')" class="px-2 py-1 border rounded italic">I</button>
                <button type="button" @click="exec('underline')" class="px-2 py-1 border rounded underline">U</button>

                <!-- Выравнивание -->
                <button type="button" @click="exec('justifyLeft')" class="px-2 py-1 border rounded">⬅️</button>
                <button type="button" @click="exec('justifyCenter')" class="px-2 py-1 border rounded">↔️</button>
                <button type="button" @click="exec('justifyRight')" class="px-2 py-1 border rounded">➡️</button>
                <button type="button" @click="exec('justifyFull')" class="px-2 py-1 border rounded">≡</button>

                <select @change="exec('fontSize', $event.target.value)" class="border p-1">
                    <option value="3">Размер</option>
                    <option value="1">Мелкий</option>
                    <option value="3">Обычный</option>
                    <option value="5">Крупный</option>
                    <option value="7">Очень большой</option>
                </select>

                <button type="button" @click="insertTable" class="px-2 py-1 border rounded">Таблица</button>
                <label class="px-2 py-1 border rounded cursor-pointer">
                    Картинка
                    <input type="file" class="hidden" @change="insertImage($event)">
                </label>
            </div>
        </div>

        <div>
            <!-- Редактор -->
            <!-- редактор -->
            <div
                x-data="{ content: @entangle('content').defer }"
                class="border rounded p-2 min-h-[200px] bg-white"
                x-ref="editor"
                contenteditable="true"
                x-html="content"
                @input="content = $refs.editor.innerHTML">
            </div>

            <!-- скрытое поле для Livewire валидации -->
            <input type="hidden" wire:model="content">
            @error('content') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

            <button type="submit" class="mt-3 px-4 py-2 text-white bg-green-600 rounded">
                {{ $editingId ? 'Сохранить изменения' : 'Добавить шаблон' }}
            </button>
        </div>
    </form>
</div>

<script>
    function editor() {
        return {
            content: @entangle('content').defer,
            exec(cmd, value = null) {
                document.execCommand(cmd, false, value);
            },
            insertTable() {
                const rows = prompt('Сколько строк?', 2);
                const cols = prompt('Сколько колонок?', 2);
                if (rows > 0 && cols > 0) {
                    let table = '<table style="border-collapse:collapse;width:100%">';
                    for (let i = 0; i < rows; i++) {
                        table += '<tr>';
                        for (let j = 0; j < cols; j++) {
                            table += '<td style="border:1px solid gray; padding:5px;">Ячейка</td>';
                        }
                        table += '</tr>';
                    }
                    table += '</table>';
                    document.execCommand('insertHTML', false, table);
                }
            }
            ,
            insertImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.execCommand('insertImage', false, e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            },
            newParagraph() {
                document.execCommand('insertHTML', false, '<p><br></p>');
            }
        }
    }
</script>
