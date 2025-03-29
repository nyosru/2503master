<div class="xoverflow-x-auto relative">

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.adm_role_column','name'=>'Путь заказа, доступы'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="flex flex-col">

        <div class="flex bg-gray-300 " style="position: sticky; top: 0; z-index: 10;" >
            <div class="w-[200px] xflex-shrink-0 xsticky xleft-0 bg-gray-300 border border-gray-200 px-4 py-2">Путь заказа ->
                <br/>
                -------
                <br/>
                Роли
            </div>
            @foreach ($columns as $column)
                <div class="w-[60px]
                 box_rotate
                bg-gray-300 border border-gray-200 px-4 py-2 чtext-center">
                    {{ $column->name }}

{{--                    @permission('разработка')--}}
{{--                    <span class="float-right" >--}}
{{--                    <livewire:cms2.leed.column-config :key="$column->id" :column="$column"/>--}}
{{--                        </span>--}}
{{--                    @endpermission--}}

                </div>
            @endforeach
        </div>
        <div class="bg-white">
            @foreach ($roles as $role)
                <div class="flex hover:bg-gray-100">
                    <div
                        style="position: sticky; left: 0;  z-index: 9;"
                        class="
                    w-[200px]
                    border border-gray-200 px-4 py-2">{{ $role->name }}</div>
                    @foreach ($columns as $column)
                        <div class="w-[60px] border border-gray-200 px-4 py-2 text-center">
                            <input type="checkbox"
                                   wire:model.defer="access.{{ $role->id }}.{{ $column->id }}"
                                   wire:click="toggleAccess({{ $role->id }}, {{ $column->id }})"
                                   @if($column->roles()->where('role_id', $role->id)->exists()) checked @endif>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-2 text-green-500">{{ session('message') }}</div>
    @endif
</div>
