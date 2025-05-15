<div>
    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if(empty($roles->toArray()))
        <div class="bg-yellow-300 px-2 py-1 rounded">Создать приглашение:<br/>В&nbsp;доске нет&nbsp;ролей, создайте&nbsp;их
{{--            через <a href="{{ route('admin.roles.index') }}">меню ролей</a>--}}
        </div>
    @else
        <p>
            <a href="#" wire:click.prevent="toggleForm" class="text-blue-500 hover:text-blue-700">
                {{ $showForm ? 'Скрыть форму' : 'создать приглашение' }}
            </a>
        </p>

        <div wire:show="showForm" style="display: none;"
             class="max-w-md mx-auto bg-white p-6 rounded shadow"
        >
            <form wire:submit.prevent="submit" class="space-y-4">

                @if($show_select_board_id)
                    <div>
                        <label class="block mb-1 font-medium">Доска</label>
                        <select wire:model="board_id" class="w-full border rounded p-2">
                            <option value="">Выберите доску</option>
                            @foreach($boards as $board)
                                <option value="{{ $board->id }}">{{ $board->name ?? 'ID: '.$board->id }}</option>
                            @endforeach
                        </select>
                        @error('board_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif

                <div>
                    <label class="block mb-1 font-medium">Телефон</label>
                    <input type="text" wire:model="phone" class="w-full border rounded p-2" maxlength="20"
                           placeholder="79991234567" required>
                    @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Роль</label>
                    <select wire:model="role_id" class="w-full border rounded p-2" required>
                        <option value="">Выберите роль</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name ?? 'ID: '.$role->id }}</option>
                        @endforeach
                    </select>
                    @error('role_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{--                кто пригласил--}}
                @if(1==2)
                    <div>
                        <label class="block mb-1 font-medium">Пользователь (необязательно)</label>
                        <select wire:model="user_id" class="w-full border rounded p-2">
                            <option value="">Не выбрано</option>
                            @foreach($users as $user)
                                <option
                                    value="{{ $user->id }}">{{ $user->name ?? $user->phone ?? 'ID: '.$user->id }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Создать приглашение
                </button>
            </form>
        </div>
    @endif
</div>
