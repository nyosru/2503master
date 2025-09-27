<div class="p-4 bg-white rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Документы</h3>

    <ul>
        @foreach($documentLinks as $doc)
            <li>
                <a href="{{ $doc['url'] }}" target="_blank">{{ $doc['name'] }}</a>
                <!-- Пример простого поля для редактирования -->
                <input type="text" wire:model.defer="documentsTemplates.{{ $doc['id'] }}" />
                <button wire:click="editDocument('{{ $doc['id'] }}', documentsTemplates[{{ $doc['id'] }}] ?? '')">Сохранить</button>
            </li>
        @endforeach
    </ul>

</div>

<script>
    window.addEventListener('printDocument', event => {
        const url = event.detail.url;
        const printWindow = window.open(url, '_blank');
        printWindow.focus();
        printWindow.print();
    });
</script>
