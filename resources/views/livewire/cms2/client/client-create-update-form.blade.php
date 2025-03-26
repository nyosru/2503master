<div class="container mx-auto">

    <div class="app-content-header"> <!--begin::Container-->

        @livewire('Cms2.App.Breadcrumb', ['menu'=>[
        ['route'=>'clients','name'=>'Клиенты'],
        ['link'=>'no','name'=> ( $name_i ? "$name_f $name_i $name_o" : ( $type_form == 'new' ? 'Создать клиента' :
        'Клиент X' ) ) ]
        ] ])

    </div>

    @if ( $client )

        {{--        <pre>{{ print_r($client) }}</pre>--}}

        <div class=" relative">
            <form
                wire:submit.prevent="save"

                class="px-8 pt-6 pb-8 mb-4">
                <div class="flex flex-row md:flex-col mb-5 ">

                    <div class="flex flex-row space-x-3">
                        <div class="w-1/3">

                            @if( $physical_person == 'no' || $physical_person == 'yes' )

                                @if( $physical_person != 'yes')
                                    <div class="w-full bg-gray-200 p-2 my-2">Контактное лицо</div>
                                @endif

                                <div class="mb-4">
                                    <label for="name_f" class="block text-gray-700 text-sm">Фамилия:<sup
                                            class="text-red-500">*</sup></label>
                                    {{--                                <input type="text" id="name_f" wire:model="name_f" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
                                    <div class="relative">
                                        <input type="text" id="name_f" wire:model="name_f"
                                               class="shadow appearance-none
                                               @error('name_f') border-2 border-red-500 @else border @enderror
                                                rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                               required>
                                        @if( !empty($name_f) )
                                            @include('inf.copy',['id'=>'name_f'])
                                        @endif
                                    </div>
                                    @error('name_f') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm">Имя:<sup class="text-red-500">*</sup>
                                        <div class="relative">
                                            <input type="text" wire:model="name_i"
                                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                                   required>
                                            @if( !empty($name_i) )
                                                @include('inf.copy',['id'=>'name_i'])
                                            @endif
                                        </div>
                                    </label>
                                    @error('name_i') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm">Отчество:
                                        <div class="relative">
                                            <input type="text" wire:model="name_o"
                                                   class="shadow appearance-none
                                                @error('phone') border-2 border-red-500 @else border @enderror
                                                rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                            >
                                            @if( !empty($name_o) )
                                                @include('inf.copy',['id'=>'name_o'])
                                            @endif
                                        </div>
                                    </label>
                                    @error('name_o') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>


                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm ">Телефон:<sup
                                            class="text-red-500">*</sup>
                                        {{--                                <input type="text" id="phone" wire:model="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
                                        <div class="relative">
                                            <input type="text" wire:model="phone"
                                                   class="shadow appearance-none
                                               @error('phone') border-2 border-red-500 @else border @enderror
                                                rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                                   required>
                                            @if( !empty($phone) )
                                                @include('inf.copy',['id'=>'phone'])
                                            @endif
                                        </div>
                                    </label>
                                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm ">Email:</label>
                                    {{--                                <input type="email" id="email" wire:model="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
                                    <div class="relative">
                                        <input type="text" id="email" wire:model="email"
                                               class="shadow appearance-none
                                               @error('email') border-2 border-red-500 @else border @enderror
                                                rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                        @if( !empty($email) )
                                            {{--                                        <button type="button" onclick="copyToClipboard('email')" class="absolute inset-y-0 right-0 flex items-center pr-3 ">--}}
                                            {{--                                            <svg style="width:24px;" class="opacity-50 hover:opacity-75 " data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><style>.cls-1{fill:#231f20;}</style></defs><title>Wondicon - UI (Free)</title><path class="cls-1" d="M75,80H29.31a5,5,0,0,1-3.53-8.54L71.46,25.78A5,5,0,0,1,80,29.31V75A5,5,0,0,1,75,80ZM41.38,70H70V41.38Z"/><path class="cls-1" d="M105.85,155H29.31a5,5,0,0,1-5-5V75a5,5,0,0,1,10,0v70h71.54A14.17,14.17,0,0,0,120,130.85V34.31H75a5,5,0,1,1,0-10h50a5,5,0,0,1,5,5V130.85A24.17,24.17,0,0,1,105.85,155Z"/><path class="cls-1" d="M151.54,175.69H75a5,5,0,0,1-5-5V150a5,5,0,0,1,10,0v15.69h71.54a14.17,14.17,0,0,0,14.15-14.15V54.81H125a5,5,0,0,1,0-10h45.69a5,5,0,0,1,5,5V151.54A24.17,24.17,0,0,1,151.54,175.69Z"/><path class="cls-1" d="M100,105H50a5,5,0,0,1,0-10h50a5,5,0,0,1,0,10Z"/><path class="cls-1" d="M100,129.91H50a5,5,0,0,1,0-10h50a5,5,0,0,1,0,10Z"/><path class="cls-1" d="M150,129.91H125a5,5,0,0,1,0-10h25a5,5,0,0,1,0,10Z"/><path class="cls-1" d="M150,105H125a5,5,0,0,1,0-10h25a5,5,0,0,1,0,10Z"/></svg>--}}
                                            {{--                                        </button>--}}
                                            @include('inf.copy',['id'=>'email'])
                                        @endif
                                    </div>

                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

{{--                                <div class="mb-4">--}}
{{--                                    <label for="physical_person" class="block text-gray-700 text-sm">Активный?:--}}
{{--                                        <select wire:model="active"--}}
{{--                                                class="shadow appearance-none border rounded w-[80px] py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                                            <option value="yes" @if($active == 'yes') selected @endif >Да</option>--}}
{{--                                            <option value="no" @if($active == 'no') selected @endif >Нет</option>--}}
{{--                                        </select>--}}
{{--                                    </label>--}}
{{--                                </div>--}}


                            @endif
                        </div>
                        <div class="w-2/3 flex flex-col">

                            <!-- Выбор типа клиента -->
                            <div class="mb-4">
                                <label for="physical_person" class="block text-gray-700 text-sm">Тип
                                    клиента:</label> $physical_person: {{ $physical_person }}
                                <select wire:model.live="physical_person" id="physical_person"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @if( $type_form == 'new' )
                                        <option value="">-- выберите --</option>
                                    @endif
                                    <option value="yes" @if($physical_person == 'yes') selected @endif >Физическое
                                        лицо
                                    </option>
                                    <option value="no" @if($physical_person == 'no') selected @endif >Юридическое лицо
                                    </option>
                                </select>
                            </div>

                            {{--                                Паспортные данные--}}
                            @if( $physical_person == 'yes')
                                <div class="mb-4">

                                    <div class="w-full bg-gray-200 p-2 my-2">Паспортные данные</div>

                                    <div class="flex flex-row space-x-2">
                                        {{--                                    seria_passport--}}
                                        <div class="w-[100px]">
                                            <label for="seria_passport"
                                                   class="block text-gray-700 text-sm ">Серия</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input id="seria_passport" wire:model="seria_passport"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($seria_passport) )
                                                    @include('inf.copy',['id'=>'seria_passport'])
                                                @endif
                                            </div>

                                        </div>
                                        {{--                                        nomer_passport--}}
                                        <div class="w-[120px]">
                                            <label for="nomer_passport"
                                                   class="block text-gray-700 text-sm ">Номер</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="nomer_passport" wire:model="nomer_passport"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($nomer_passport) )
                                                    @include('inf.copy',['id'=>'nomer_passport'])
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        {{--                                        passport--}}
                                        <div class="w-full">
                                            <label for="passport" class="block text-gray-700 text-sm ">Кем
                                                выдан</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="passport" wire:model="passport"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($nomer_passport) )
                                                    @include('inf.copy',['id'=>'passport'])
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="flex flex-row space-x-2">
                                        {{--                                        date_passport--}}
                                        <div class="w-[160px]">
                                            <label for="date_passport" class="block text-gray-700 text-sm ">Когда
                                                выдан</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="date" id="date_passport" wire:model="date_passport"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ">
                                                {{--                                        @if( !empty($date_passport) )--}}
                                                {{--                                            @include('inf.copy',['id'=>'date_passport'])--}}
                                                {{--                                        @endif--}}
                                            </div>

                                        </div>
                                        {{--                                        cod_passport--}}
                                        <div class="w-[160px]">
                                            <label for="cod_passport" class="block text-gray-700 text-sm ">Код
                                                подразделения</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="cod_passport" wire:model="cod_passport"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ">
                                                @if( !empty($cod_passport) )
                                                    @include('inf.copy',['id'=>'cod_passport'])
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{--                                Регистрация (прописка)--}}
                            @if( $physical_person == 'yes')
                                <div class="mb-4">

                                    <div class="w-full bg-gray-200 p-2 my-2">Регистрация (прописка)</div>

                                    <div class="flex flex-row space-x-2">
                                        {{--                                city--}}
                                        <div class="w-1/2">
                                            <label for="city" class="block text-gray-700 text-sm ">Город</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="city" wire:model="city"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($city) )
                                                    @include('inf.copy',['id'=>'city'])
                                                @endif
                                            </div>
                                        </div>
                                        {{--                                    street--}}
                                        <div class="w-1/2">
                                            <label for="street" class="block text-gray-700 text-sm ">Улица</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="street" wire:model="street"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($street) )
                                                    @include('inf.copy',['id'=>'street'])
                                                @endif
                                            </div>
                                        </div>

                                    </div>


                                    <div class="flex flex-row space-x-2">

                                        {{--                            building--}}
                                        <div class="w-1/2">
                                            <label for="building" class="block text-gray-700 text-sm ">№ дома</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="building" wire:model="building"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($building) )
                                                    @include('inf.copy',['id'=>'building'])
                                                @endif
                                            </div>
                                        </div>

                                        {{--                            building_part--}}
                                        <div class="w-1/2">
                                            <label for="building_part"
                                                   class="block text-gray-700 text-sm ">корпус</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="building_part" wire:model="building_part"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($building_part) )
                                                    @include('inf.copy',['id'=>'building_part'])
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="flex flex-row space-x-2">

                                        {{--                            cvartira--}}
                                        <div class="w-1/3">
                                            <label for="cvartira" class="block text-gray-700 text-sm ">Квартира</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="cvartira" wire:model="cvartira"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($cvartira) )
                                                    @include('inf.copy',['id'=>'cvartira'])
                                                @endif
                                            </div>
                                        </div>
                                        {{--                            floor--}}
                                        <div class="w-1/3">
                                            <label for="floor" class="block text-gray-700 text-sm ">Этаж</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="floor" wire:model="floor"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($floor) )
                                                    @include('inf.copy',['id'=>'floor'])
                                                @endif
                                            </div>
                                        </div>
                                        {{--                            lift--}}
                                        <div class="w-1/3">
                                            <label for="lift" class="block text-gray-700 text-sm ">Лифт</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="lift" wire:model="lift"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($lift) )
                                                    @include('inf.copy',['id'=>'lift'])
                                                @endif
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            @endif

                            {{--                                Данные Юр лица--}}
                            @if( $physical_person == 'no')
                                <div class="mb-4">
                                    <div class="w-full bg-gray-200 p-2 my-2">Данные Юр лица</div>

                                    <div class="flex flex-col ">
                                        <div class="">
                                            <label for="ur_name" class="block text-gray-700 text-sm ">Название
                                                компании
                                                (кратко)</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                <input type="text" id="ur_name" wire:model="ur_name"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
                                                @if( !empty($ur_name) )
                                                    @include('inf.copy',['id'=>'ur_name'])
                                                @endif
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="name_company" class="block text-gray-700 text-sm ">Название
                                                компании
                                                (полное)</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                                    <textarea type="text" id="name_company" wire:model="name_company"
                                                              class="shadow appearance-none border rounded w-full h-[60px]
                                                                 py-2 px-3 text-gray-700 leading-tight
                                                                 focus:outline-none focus:shadow-outline pr-10"></textarea>

                                                @if( !empty($name_company) )
                                                    @include('inf.copy',['id'=>'name_company'])
                                                @endif
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="ur_passport" class="block text-gray-700 text-sm ">Карточка
                                                предприятия</label>
                                            {{--                                <input type="text" id="address" wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 1required>--}}
                                            <div class="relative">
                                            <textarea type="text" id="ur_passport" wire:model="ur_passport"
                                                      class="shadow appearance-none border rounded w-full h-[150px]
                                                        py-2 px-3 text-gray-700 leading-tight
                                                        focus:outline-none focus:shadow-outline pr-10"></textarea>
                                                @if( !empty($ur_passport) )
                                                    @include('inf.copy',['id'=>'ur_passport'])
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="p-2">

                        @if (session()->has('message'))
                            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session()->has('msgUserEdit'))
                            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                                {{ session('msgUserEdit') }}
                            </div>
                        @endif

                        @if (session()->has('errorUserEdit'))
                            <div class="mb-4 p-4 bg-red-200 text-black rounded">
                                {{ session('errorUserEdit') }}
                            </div>
                        @endif

                        @if( $physical_person == 'no' || $physical_person == 'yes' )
                            @if( $type_form == 'new' )
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                    Создать
                                </button>
                            @elseif( $type_form == 'update' )

                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                    Сохранить
                                </button>
                            @endif
                        @endif

                    </div>
                </div>
            </form>
        </div>

        @permission('разработка')
        @if( $type_form == 'edit')
            <pre style="max-height: 200px; overflow: auto;">{{ print_r($client->toArray()) }}</pre>
        @endif
        @endpermission

    @else
        <p>Клиент не найден.</p>
    @endif


</div>
