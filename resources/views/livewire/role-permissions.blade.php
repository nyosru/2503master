<div class="px-4">

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.role_permission','name'=>'Управление разрешениями для ролей'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

{{--    <h2 class="text-xl font-bold mb-4">Управление разрешениями для ролей</h2>--}}

    <!-- Сообщение об успехе -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    {{--    посмотреть список доступов ваш (текущего пользователя)--}}
    {{--    <h3>Разрешения пользователя:</h3>--}}
    {{--    <ul>--}}
    {{--        @foreach (auth()->user()->getAllPermissions() as $permission)--}}
    {{--            <li>{{ $permission->name }}</li>--}}
    {{--        @endforeach--}}
    {{--    </ul>--}}
    {{--    <br/>--}}
    {{--    <br/>--}}


    <div class="relative">
        <div class="max-w-full">
            <div class="flex flex-col">
                <!-- Заголовок таблицы -->
                <div class="flex bg-gray-200 sticky top-0">
                    <div class="bg-gray-200 z-20 border border-gray-300 px-4 py-2 font-bold w-48">
                        Роль
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="z-20
                         @if( strpos($permission->name,' /') || strpos($permission->name,' //') )
                         bg-gray-100
                         @else
                        bg-gray-200 border-r-[5px]
                         @endif

                         border border-gray-300
                         border-t-[5px]

                        px-4 py-2 text-center
                        чw-48
                        w-20
                        box_rotate">


                            {{-- разработка--}}
                            @permission('разработка')
                            <button
                                x-data
                                x-on:click="
                                    const textToCopy = $el.getAttribute('to-copy');
                                    navigator.clipboard.writeText(textToCopy)
                                    //    .then(() => $dispatch('notify', 'Текст скопирован: ' + textToCopy))
                                        .catch(err => console.error('Ошибка при копировании:', err));
                                    "
                                to-copy="{{ $permission->name }}"
                                class="text-gray"
                                style="float:right;"
                                title="sort {{ $permission->sort }}"
                            >
                                <img src="/icon/copy.svg" alt="" border="" class="w-[20px]"/>
                            </button>
                            @endpermission

                            @if( strpos($permission->name,' /') )
                                <small>
                            @endif
                            {!! str_replace(
                                [
									' /',
									'CRUD',
									'//'
									//
									],
                                [
									'</small><br/>',
									'<abbr title="добавить изменить удалить" >CRUD</abbr>',
									'<br/>'
									//
                                    ],
                                $permission->name)
                            !!}
                        </div>
                    @endforeach
                </div>

                <!-- Тело таблицы -->
                @foreach ($roles as $index => $role)
                    <div class="flex {{ $index % 2 == 0 ? 'bg-white' : 'bg-cyan-100' }}">
                        <!-- Левый столбец -->
                        <div
                            class="sticky left-0 xbg-white z-10 border border-gray-300 px-4 py-2 font-bold w-48   {{ $index % 2 == 0 ? 'bg-white' : 'bg-cyan-100' }}">
                            <div class="flex justify-between items-center"
                                {{--                                 style="z-index: 500;"--}}
                            >
{{--                                <pre>{{ print_r( $role->toArray() ) }}</pre>--}}
                                <span>{{ $role->name }} <sup title="доска: {{ $role->board_id }}">д:{{ $role->board_id }}</sup></span>
                                @can('р.Права доступа / CRUD роли')
                                    <button
                                        wire:click="confirmDelete({{ $role->id }})"
                                        {{--                                    wire:confirm="1111"--}}
                                        class="text-gray-300 hover:text-red-700"
                                        title="Удалить роль"
                                    >
                                        &times;
                                    </button>
                                @endcan
                            </div>
                        </div>

                        <!-- Остальные ячейки -->
                        @foreach ($permissions as $permission)
                            <div class="border border-gray-300 px-4 py-2 text-center w-20">
                                {{--                                @can('р.Права доступа / CRUD роли')--}}
                                @permission('р.Права доступа / CRUD роли')
                                <input
                                    type="checkbox"

                                    wire:click="togglePermission({{ $role->id }}, {{ $permission->id }})"
                                    @if (in_array($permission->id, $rolePermissions[$role->id] ?? [])) checked @endif
                                >
                                @else
                                    @if (in_array($permission->id, $rolePermissions[$role->id] ?? []))
                                        +
                                    @else
                                        -
                                    @endif
                                    @endpermission


                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

{{--    @can('р.Права доступа / CRUD роли')--}}
        <livewire:role-permissions-manager
{{--            :board_id="$board_id" --}}
        />
{{--    @endcan--}}

    <!-- Добавляем компонент подтверждения -->
    @if ($confirmingDelete)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-4 rounded shadow-lg">
                <h3 class="text-lg font-bold mb-4">Вы уверены, что хотите удалить эту роль?</h3>
                <div class="flex space-x-4">
                    <button wire:click="deleteRole({{ $roleIdToDelete }})"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Да
                    </button>
                    <button wire:click="cancelDelete"
                            class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{--    @script--}}
    {{--    <script>--}}
    {{--        document.addEventListener('notify', (event) => {--}}
    {{--            alert(event.detail);--}}
    {{--        });--}}
    {{--    </script>--}}
    {{--    @endscript--}}

</div>

