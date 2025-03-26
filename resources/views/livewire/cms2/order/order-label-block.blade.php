<div class="flex flex-col w-full space-y-3 ">
    <div>


        {{--метки оф--}}
        @if(1==2)
            <div class="mb-4">
                <label class="block text-gray-700 text-sm">Метки:<sup class="text-red-500">*</sup>
                    <div class="relative">
                        <input type="text" wire:model="name_i"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                        >
                        @if( !empty($name_i) )
                            @include('inf.copy',['id'=>'name_i'])
                        @endif
                    </div>
                </label>
                @error('name_i') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm">Цвет фона:<sup class="text-red-500">*</sup>
                    <div class="relative">
                        <input type="text" wire:model="name_i"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                        >
                        @if( !empty($name_i) )
                            @include('inf.copy',['id'=>'name_i'])
                        @endif
                    </div>
                </label>
                @error('name_i') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm">Цвет текста:<sup class="text-red-500">*</sup>
                    <div class="relative">
                        <input type="text" wire:model="name_i"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                        >
                        @if( !empty($name_i) )
                            @include('inf.copy',['id'=>'name_i'])
                        @endif
                    </div>
                </label>
                @error('name_i') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        {{--                метки--}}
        {{--                    <pre>{{ print_r($labels->toArray()) }}</pre>--}}
        <div style="max-height: 200px; overflow-y: auto;"
            {{--                                         style="border: 4px solid {{ $l->color }}; "--}}
        >
            @foreach( $labels as $l )
                <div class="underline mb-1 border block cursor-pointer bg-white hover:bg-blue-200"
                     wire:click.prevent="addToCreateOrder({{$l->id}})">
{{--                    <a href="#" wire:click.prevent="deleteBaseLabel({{$l->id}})" wire:confirm="удалить метку ?" class="text-red-200 hover:text-red-500 float-right pr-2">х</a>--}}

                        {{--                    <input type="checkbox" wire:model.defer="metki" value="{{ $l->id }}"--}}
                        {{--                           class="mb-1"/>--}}
                        {{ $l->name }}
                        / {{ $l->show ? 1 : 2 }}
{{--                    </a>--}}
                </div>
            @endforeach
        </div>
    </div>

    <div>
        {{--        Метки заказа--}}
        <div class="bg-gray-100 p-1 font-bold text-center">добавить метку</div>
        <form wire:submit="save">
            <input type="text" wire:model="label_new" class="w-full mb-2" required/>
            <div class="text-right">
                <button type="submit" class="bg-blue-400 px-2 py-1 rounded">Добавить метку</button>
            </div>
        </form>
        @if (session()->has('successLabel'))
            <span class="block bg-green-200 text-green-800 p-2 rounded mb-4">
                            {{ session('successLabel') }}
                        </span>
        @endif

    </div>
</div>
