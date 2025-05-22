<div>
    <div>

        <livewire:Cms2.App.Breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--                :menu="[['route'=>'leed','name'=>'Лиды'], [ 'link' => 'no', 'name'=> ( $leed->name ?? 'Лид' ) ] ]"--}}
            :menu="[
                    ['route'=>'lk.profile','name'=>'Профиль'],
                 ]"
        />
    </div>

    <div>

        <form wire:submit.prevent="save">
            <div class="container mx-auto max-w-[600px] flex flex-col space-y-2">

                <div class="container mx-auto flex flex-row space-x-4">
                    <div class="w-1/2">

                        @if (session()->has('message'))
                            <div class="alert alert-success mb-4 bg-green-300">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="block mb-2">Имя</label>
                            <input type="text" wire:model="name"
                                   class="w-full p-2 border rounded">
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2">Email</label>
                            <input type="email" wire:model="email"
                                   class="w-full p-2 border rounded">
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        @if(1==2)
                            <div class="mb-4">
                                <label class="block mb-2">Аватар</label>

                                @if($avatarPreview)
                                    <img src="{{ $avatarPreview }}"
                                         class="mb-2 w-20 h-20 rounded-full object-cover">
                                @endif

                                <input type="file" wire:model="avatar"
                                       class="w-full p-2 border rounded">
                                @error('avatar') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        @endif

                    </div>
                    <div class="w-1/2">

                        <div class="mb-4">
                            <label class="block mb-2">Телеграм</label>
                            {{ $telegram_id ?? '--' }}
                            {{--                        @if( !empty($telegram_id))--}}
                            {{--                            <a href="https://t.me/{{ $telegram_id }}">{{ $telegram_id }}</a>--}}
                            {{--                        @else--}}
                            {{--                            ----}}
                            {{--                        @endif--}}
                            {{--                        <input type="text" wire:model="telegram_id"--}}
                            {{--                               class="w-full p-2 border rounded"--}}
                            {{--                               readonly--}}
                            {{--                        >--}}
                            {{--                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror--}}
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2">Телефон</label>
                            {{ $phone_number ?? '--' }}
                            {{--                        <input type="text" wire:model="phone_number"--}}
                            {{--                               readonly--}}
                            {{--                               class="w-full p-2 border rounded">--}}
                            {{--                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror--}}
                        </div>

                    </div>
                </div>

                <div class="container mx-auto flex flex-row">
                    <div class="w-1/2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Сохранить изменения
                        </button>
                    </div>
                    <div class="w-1/2">
                    </div>
                </div>

            </div>

        </form>
    </div>

</div>
