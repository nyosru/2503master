<div>
    <form wire:submit="save">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Контент</label>
            <div class="simple-editor">
                <div class="editor-toolbar">
                    <button type="button" onclick="formatText('bold')"><strong>B</strong></button>
                    <button type="button" onclick="formatText('italic')"><em>I</em></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>

                    <!-- Добавляем выбор размера шрифта -->
                    <select id="fontSizeSelect" onchange="setFontSize(this.value)" aria-label="Выбор размера шрифта">
                        <option value="">Размер шрифта</option>
                        <option value="1">10px</option>
                        <option value="2">13px</option>
                        <option value="3">16px</option>
                        <option value="4">18px</option>
                        <option value="5">24px</option>
                        <option value="6">32px</option>
                        <option value="7">48px</option>
                    </select>

                    <!-- Кнопка добавления ссылки -->
                    <button type="button" onclick="addLink()">Вставить ссылку</button>

                    <!-- Кнопка вставки таблицы -->
                    <button type="button" onclick="insertTable()">Вставить таблицу</button>
                </div>
                <div
                    contenteditable="true"
                    class="content"
                    id="simple-editor"
                    style="min-height: 250px; outline: none;"
                    wire:ignore
                ></div>
            </div>
        </div>

        <input type="submit" value="Сохранить" />
    </form>

    <div>Content: {{ Str::limit($content, 100) }}</div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const editor = document.getElementById('simple-editor');

            if (@this.content) {
                editor.innerHTML = @this.content;
            }

            function updateContent() {
            @this.set('content', editor.innerHTML);
            }

            editor.addEventListener('input', updateContent);
            editor.addEventListener('blur', updateContent);

            window.formatText = function(format) {
                document.execCommand(format, false);
                updateContent();
            }

            window.setFontSize = function(size) {
                if(size) {
                    document.execCommand('fontSize', false, size);
                    updateContent();
                    document.getElementById('fontSizeSelect').value = '';
                }
            }

            window.addLink = function() {
                let url = prompt('Введите URL для ссылки:', 'https://');
                if (url) {
                    document.execCommand('createLink', false, url);
                    updateContent();
                }
            }

            window.insertTable = function() {
                let rows = prompt('Введите количество строк таблицы:', 2);
                let cols = prompt('Введите количество столбцов таблицы:', 2);
                rows = parseInt(rows);
                cols = parseInt(cols);
                if(rows > 0 && cols > 0) {
                    let table = '<table border="1" style="border-collapse: collapse;">';
                    for(let r = 0; r < rows; r++) {
                        table += '<tr>';
                        for(let c = 0; c < cols; c++) {
                            table += '<td>&nbsp;</td>';
                        }
                        table += '</tr>';
                    }
                    table += '</table><br/>';
                    document.execCommand('insertHTML', false, table);
                    updateContent();
                } else {
                    alert('Введите корректное число строк и столбцов');
                }
            }
        });
    </script>

    <style>
        .content div{ margin-bottom: 10px;}

        .content .simple-editor {
            min-height: 300px;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem;
            background: white;
        }
        .content .editor-toolbar {
            background: #f3f4f6;
            padding: 0.5rem;
            border-bottom: 1px solid #d1d5db;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .content .editor-toolbar button,
        .content .editor-toolbar select {
            background: white;
            border: 1px solid #d1d5db;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.875rem;
        }
        .content a{ color: blue; text-decoration: underline;}
         .content .editor-toolbar button:hover,
        .content .editor-toolbar select:hover {
            background: #e5e7eb;
        }
        .content .editor-toolbar select {
            cursor: pointer;
        }
        .content table {
            width: auto;
        }
        .content table td {
            min-width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
        }
    </style>
</div>
