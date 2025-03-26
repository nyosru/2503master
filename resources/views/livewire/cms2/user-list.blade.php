<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.user_list','name'=>'Пользователи'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>


    <div>


        {{--        <pre>--}}
        {{--            {{ print_r(auth()->user()) }}--}}
        {{--        </pre>--}}




        {{--    @if (auth()->user()->can('разделПользователи'))--}}
        {{--            <!-- Код, который видит пользователь с разрешением -->--}}
        {{--            Раздел пользователей доступен--}}
        {{--        @else--}}
        {{--            <!-- Код, если у пользователя нет разрешения -->--}}
        {{--            Раздел пользователей недоступен--}}
        {{--        @endif--}}

        {{--        <br/>--}}
        {{--        <br/>--}}
        {{--        <br/>--}}

        {{--            @can('разделПользователи')--}}
        {{--                <p>У вас есть доступ к разделу пользователей.</p>--}}
        {{--            @else--}}
        {{--                <p>У вас нет доступа к разделу пользователей.</p>--}}
        {{--            @endcan--}}
        {{--            <br/>--}}
        {{--            <br/>--}}
        {{--        @can('разделПользователи')--}}
        {{--            разделПользователи+++--}}
        {{--        @else--}}
        {{--            разделПользователи нет--}}
        {{--        @endcan--}}

        <table class="table-permission table-auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Роль</th>
                @permission('р.Пользователи / Изменять роли')
                <th>Изменить роль</th>
                @endpermission

                <th>Пользователь<br/>marudi.store</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class=" @if($user->deleted_at) line-through @endif ">{{ $user->name }}
                        {{--                    <pre class="text-sm max-h-[200px] overflow-auto">{{ print_r($user->toArray()) }}</pre>--}}



                        @if($user->deleted_at)
                            @permission('р.Пользователи / восстановить')
                            <span class="float-right text-red-300 hover:text-red-600">
                        <button
                            title="восстановить пользователя"
                            type="button"
                            wire:confirm="Восстановить пользователя ?"
                            wire:click="unDeleteUser({{$user->id}})">вернуть</button>
                        </span>
                            @endpermission

                        @else
                            @permission('р.Пользователи / удалить')
                            <span class="float-right text-red-300 hover:text-red-600">
                        <button
                            title="Удалить пользователя"
                            type="button"
                            wire:confirm="Удалить пользователя ?"
                            wire:click="deleteUser({{$user->id}})">x</button>
                        </span>
                            @endpermission
                        @endif

                    </td>
                    <td>{{ $user->email }}</td>
                    <td>

                        {{ $user->roles[0]->name ?? '-'}}

                    </td>

                    @permission('р.Пользователи / Изменять роли')
                    <td>

                        @if($user->deleted_at)
                        @else

                            {{--                        @can('р.Сотр.изменить роли')--}}
                            <select wire:model.live="selected_role_id.{{ $user->id }}">
                                <option value="">Выберите новую роль</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if (!empty($new_role_message[$user->id]))
                                <div style="color: green;">{{ $new_role_message[$user->id] }}</div>
                            @endif
                        @endif
                    </td>
                    @endpermission


                    <td x-data="{
                    isChanged: false,
                    handleChange(event) {
                    this.isChanged = true;
                    },
                    hideBlock() {
                    this.isChanged = false;
                    }
                    }">

                        <div x-show="!isChanged">
                            {{ $user->staff->name ?? '' }} {{$user->staff->phone ?? '' }}
                        </div>


                        @if($user->deleted_at)
                        @else
                            @permission('р.Пользователи / выбрать пользователя с маруди')

                            {{--<pre>{{ print_r($user->staff_id) }}</pre>--}}
                            <select class="w-full min-w-[150px]"
                                    @change="handleChange($event)"
                                    wire:model.live="selected_staff.{{ $user->id }}">
                                <option value="">Выберите пользователя из marude.store</option>
                                @foreach ($stafs as $s)
                                    {{--                                @if($user->staff_id == $s->id) <option>222</option> @endif--}}
                                    <option value="{{ $s->id }}" @if($user->staff_id == $s->id) selected @endif >
                                        {{ $s->name }} {{$s->phone}} ({{ $s->id }})
                                    </option>
                                @endforeach
                            </select>
                            {{--                        staff--}}
                            @if (!empty($new_staff_message[$user->id]))
                                <div style="color: green;">{{ $new_staff_message[$user->id] }}</div>
                            @endif
                        @endif
                        @endpermission


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    @if(1==2)

        {{--    <pre style="max-height: 100px; font-size: 10px; overflow: auto;">{{ print_r($users->toArray()) }}</pre>--}}
        <table class="table-auto">
            <thead>
            <tr>
                @foreach( array_keys($users->toArray()[0]) as $k => $v )
                    <th class="bg-white p-2">{{ $v }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach( $users->toArray() as $k => $v )
                <tr class="bg-zinc-100 hover:bg-zinc-300">
                    @foreach( array_keys($users->toArray()[0]) as $k1 => $v1 )
                        {{--                    <td class=" p-2">{{ $v[$v1] ?? '-' }}</td>--}}
                        <td class=" p-2">
                            @if( is_array($v[$v1]))

                                @foreach( $v[$v1] as $vv )
                                    @if( !empty($vv['name']) )
                                        {{ $vv['name'] }}<br/>
                                    @endif
                                @endforeach

                            @else
                                {{ $v[$v1] ?? '-' }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="10">

                        @can('разделПользователи')
                            разделПользователи+++
                        @else
                            разделПользователи нет
                        @endcan


                        {{--                    {{ $v->role->name ?? 'role name--' }}--}}

                        {{--                                        <select wire:model="selected_role_id.{{ $user->id }}">--}}

                        <select wire:model.live="selected_role_id.{{ $v['id'] }}">
                            <option value="">Выберите роль</option>
                            @foreach ($roles as $role)
                                {{--                                                <option value="{{ $role->id }}" @selected(old('selected_role_id.' . $user->id) == $role->id)>--}}
                                <option
                                    value="{{ $role->id }}" @selected(old('selected_role_id.' . $v['id']) == $role->id)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        {{--                                        @if (!empty($new_role_message[$user->id]))--}}
                        @if (!empty($new_role_message[$v['id']]))
                            {{--                                            <span style="color: green;">{{ $new_role_message[$user->id] }}</span>--}}
                            <span style="color: green;">{{ $new_role_message[$v['id']] }}</span>
                        @endif


                        {{--                    <pre>{{ print_r($v) }}</pre>--}}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
