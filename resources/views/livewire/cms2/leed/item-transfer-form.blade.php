<div class="mt-2 mx-2">

    @if (session()->has('transferRecordMessage'))
        <div class="mt-2 bg-green-500 p-2">{{ session('transferRecordMessage') }}</div>

    @else
        <form wire:submit.prevent="transferLead">

{{--            <pre class="text-xs">{{ print_r($users->toArray()) }}</pre>--}}

            <select class="w-full rounded text-gray-600" wire:model.live="sendToUser">
                <option value="">Кому передать?</option>
                @foreach($users as $u)
                    @if( isset($u->roles[0]) )
                        <option value="{{ $u->id }}">{{ $u->name ?? '-' }} {{ $u->roles[0]->name ?? '-' }}</option>
                    @endif
                @endforeach
            </select>

            @if( !empty($sendToUser))
                <div class="text-right mt-2">
                    <button class="bg-blue-500 px-2 py-1" type="submit">Передать</button>
                </div>
            @endif
        </form>
    @endif

    @if (session()->has('transferRecordError'))
        <div class="mt-2 text-red-500">{{ session('transferRecordError') }}</div>
    @endif

</div>
