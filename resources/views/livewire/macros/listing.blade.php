<div>

    <h2 class="mt-8 font-bold text-xl">Список макросов</h2>

{{--    <pre class="text-xs">{{ print_r($macroses->toArray()) }}</pre>--}}

    <ul class="mt-4 space-y-2">
        @forelse ($macroses as $macro)
            <livewire:macros.list-item :item="$macro" :key="'macro'.$macro->id"/>
        @empty
            <li>Макросов нет.</li>
        @endforelse
    </ul>
</div>
