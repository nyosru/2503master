<span>
{{--    <a href="#" wire:click="openModal" class="text-blue-500 hover:underline">передать лида</a>--}}
{{--        <pre class="text-xs">{{ print_r($move_variants->toArray(),true) }}</pre>--}}

    <a
        title="Передать лида"
        href="#" wire:click.prevent="openModal" class="text-blue-500 hover:underline"><img src="/icon/arrow-right.png"
                                                                                   class="w-[28px]"/></a>

    @if( $isOpen )
        <div
            {{--        x-data="{ isOpen: @entangle('isOpen') }" x-show="isOpen"--}}
            class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-screen bg-black bg-opacity-50">
        <div class="bg-white rounded shadow-md p-4 w-1/2">
            <form wire:submit.prevent="submit">
                <h2 class="text-lg font-bold mb-4">Передать лида</h2>
                <div class="my-2">
                    <label for="user" class="block text-sm font-medium text-gray-700">Пользователь</label>
                    <select wire:model="selectedUser" id="user"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                        <option value="">выберите</option>
{{--                        @foreach($users as $user)--}}
                        @foreach($move_variants as $m)
                            @if( $m->user_id != Auth::user()->id )
                            <option
                                value="{{ $m->user_id }}">
                                {{ $m->user->name }}
                                {{ $m->user->phone_number ?? '-' }}
{{--                                <pre>{{ $m->user_id }}</pre>--}}
{{--                                ({{ $m->role->name ?? '' }})--}}
                            </option>
                            @endif
                        @endforeach
                    </select>
{{--                    <pre>{{ print_r($users->toArray()) }}</pre>--}}
                </div>
                <div class="text-right">
                    <button type="button" wire:click="closeModal"
                            class="px-2 py-1 xfont-bold xtext-white bg-gray-200 rounded hover:bg-red-700">Отмена
                    </button>
                    <button type="submit" class="px-2 py-1 xfont-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Передать
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</span>
