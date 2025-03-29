<div
    class="container div-strip-bg
{{--        @if($modal_view1) w-full xw-full @else w-[500px] @endif--}}
         w-[700px]
    "
    draggable="false"
>

    {{--    $modal_view1: {{ $modal_view1 ?? 'x' }}--}}

    @permission('разработка')
    разработка/order-create
    @endpermission

    @if(!$modal_view1)
        {{-- Breadcrumb and header --}}
        <div class="app-content-header">
            <livewire:Cms2.App.Breadcrumb :menu="[
            ['route'=>'order.index','name'=>'Заказы'],
            ['link'=>'no','name'=>'Создать заказ'],
        ]"/>
        </div>
    @endif

    <style>

        /*.div-strip-bg > div:nth-child(odd) {*/
        /*    background-color: white;*/
        /*}*/

        .div-strip-bg h2 {
            display: block;
            background-color: #efefef;
            padding: 5px 10px;
            font-weight: bold;
        }

    </style>

    <div>
        {{--    <div class="flex flex-row items-end w-full space-x-3 p-3">--}}

        {{--        <div class="w-1/2">--}}
        <form wire:submit="save">

            {{--        клиент--}}


            {{--                Клиент--}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm px-5">Клиент:

                    {{--                        <input type="text" wire:model="name_i"--}}
                    {{--                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"--}}
                    {{--                               required>--}}
                    <select wire:model="client_id" id="client_id"
                            class="w-full"
                            @if( !empty($client_to_order_id )  )
                                disabled
                        @endif

                    >
                        <option>== выбрать клиента > ФИО (компания)</option>
                        @foreach($clients as $c)
                            <option value="{{$c['id']}}"
                            >{{$c['fio']}}@if( !empty($c['company']))
                                    ({{$c['company']}})
                                @endif</option>
                        @endforeach
                    </select>
                    {{--                                @if( !empty($client_id) )--}}
                    {{--                                    @include('inf.copy',['id'=>'client_id'])--}}
                    {{--                                @endif--}}
                </label>
                @error('client_id') <span class="bg-red-100 p-1 text-red-500 text-sm">{{ $message }}</span> @enderror

            </div>

            {{--        название, данные заказа--}}
            <h2>
                Заказ
                {{--                @permission('разработка')--}}
                @if( !empty($return_leed_name) )
                    ( будет добавлен в лид: {{ $return_leed_name }})
                @endif
                {{--                @endpermission--}}
            </h2>

            <div class="flex
{{--                @if($modal_view1) flex-col @else flex-row @endif--}}
flex-col
                w-full space-x-3 p-3">
                <div class="
{{--                @if($modal_view1) w-full @else w-1/2 @endif--}}
                ">

                    {{--@if( !empty($client_id))--}}
                    @if( 1==1)
                        {{--            <pre class="text-xs overflow-auto max-h-[200px] border border-green-500">{{ print_r($clients->toArray(),true) }}</pre>--}}
                        {{--                        Название--}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm">Название:<sup
                                    class="text-red-500">*</sup>
                                <div class="relative">
                                    <input type="text" wire:model="name" id="name"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                           required>
                                    @if( !empty($name) )
                                        @include('inf.copy',['id'=>'name'])
                                    @endif
                                </div>
                            </label>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                        {{--                    Тип изделия - олд--}}
                        @if(1==2)
                            <div class="mb-4">
                                @permission('разработка')
                                $types
                                @endpermission
                                <label class="block text-gray-700 text-sm">Тип изделия:<sup
                                        class="text-red-500">*</sup>
                                    <div class="relative">
                                        <input type="text" wire:model="types" id="types"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                        >
                                        @if( !empty($types) )
                                            @include('inf.copy',['id'=>'types'])
                                        @endif
                                    </div>
                                </label>
                                @error('types') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <div class="flex flex-row space-x-2">
                            <div class="w-1/2 mb-4">
                                @permission('разработка')
                                order_product_type_id
                                @endpermission
                                <label class="block text-gray-700 text-sm">Тип заказа:
                                    <div class="relative">
                                        <select wire:model="order_product_type_id" id="order_product_type_id">
                                            <option>- выбрать -</option>
                                            @foreach($product_type as $i)
                                                <option
                                                    value="{{$i['id']}}">{{$i['name']}} {{ $c['types'] ?? '' }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </label>
                                @error('order_product_type_id') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="w-1/2 mb-4">
                                @permission('разработка')
                                <div class="bg-yellow-100 p-1">
                                    // срочно
                                    public $urgently;
                                </div>
                                @endpermission
                                <label class="block text-gray-700">
                                    Срочный заказ
                                    <input type="checkbox" wire:model="urgently" class="ml-2"/>
                                </label>
                                @error('urgently') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(1==2)
                        <div class="flex flex-row space-x-2">
                            <div class="
{{--                            @if($modal_view1) w-1/4 @else w-1/2 @endif--}}
w-1/2
                            ">
                                @permission('разработка')
                                montag_date
                                @endpermission
                                <label class="block text-gray-700 text-sm">Дата монтажа:
                                    <div class="relative">
                                        <input type="date" wire:model="montag_date" id="montag_date"
                                               class="w-full shadow appearance-none border rounded
                                                   xw-full py-2 px-3 text-gray-700 leading-tight
                                                   focus:outline-none focus:shadow-outline pr-10"
                                        >
                                        @if( !empty($ready_dates) )
                                            @include('inf.copy',['id'=>'montag_date'])
                                        @endif
                                    </div>
                                </label>
                                @error('montag_date') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="w-3/4 mb-4">
                                @permission('разработка')
                                adres
                                @endpermission
                                <label class="block text-gray-700 text-sm">Адрес монтажа:
                                    <div class="relative">
                                        <input type="text" wire:model="adres" id="adres"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                        >
                                        @if( !empty($adres) )
                                            @include('inf.copy',['id'=>'adres'])
                                        @endif
                                    </div>
                                </label>
                                @error('adres') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    @endif
                    @endif
                </div>
                {{--                            Комментарий--}}
                <div class="
{{--                    @if($modal_view1) w-full @else w-1/2 @endif--}}
                    ">
                    <label class="block text-gray-700 text-sm">Комментарий:
                        <div class="relative">
                            <input type="text" wire:model="montag_date_comment"
                                   id="montag_date_comment"
                                   class="shadow appearance-none border rounded w-full py-2 px-3
                                                text-gray-700 leading-tight focus:outline-none
                                                focus:shadow-outline xpr-10"
                            >
                        </div>
                    </label>
                    @error('montag_date_comment') <span
                        class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="
{{--                    @if($modal_view1) w-full @else w-1/2 @endif--}}
                ">

                    {{--                        Дата монтажа--}}
                    {{--                    <div class="mb-4">--}}
                    {{--                        <div class="flex--}}
                    {{--                        @if($modal_view1) flex-col @else flex-row @endif  --}}
                    {{--                        w-full">--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </div>

            </div>


            {{--        деньги--}}
            <h2>
                Финансы
            </h2>
            <div class="flex
{{--                @if($modal_view1) flex-col @else flex-row  @endif --}}
                 flex-col
                w-full space-x-3 px-3  bg-white">
                <div class="flex-1">

                    <div class="mb-4 flex flex-row space-x-2 items-center">

                        <div class="flex-1">
                            <label class="block text-gray-700 text-sm">Общая стоимость:<sup
                                    class="text-red-500">*</sup>
                                <div class="relative">
                                    <input type="number" min="0" step="1" wire:model.live="price" id="price"
                                           class="shadow appearance-none border rounded w-full p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                           required
                                    >
                                    @if( !empty($price) )
                                        @include('inf.copy',['id'=>'price'])
                                    @endif
                                </div>
                            </label>
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-1/4">
                            <label class="block text-gray-700 text-sm"> Форма оплаты:<sup
                                    class="text-red-500">*</sup>
                                <div class="relative">
                                    {{--                            <input type="text" wire:model="name_i"--}}
                                    {{--                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"--}}
                                    {{--                                  >--}}
                                    <select class="w-full rounded p-1" wire:model="forms_payment">
                                        <option value="nal">Наличные</option>
                                        <option value="rs">Р/С</option>
                                    </select>
                                    {{--                            @if( !empty($name_i) )--}}
                                    {{--                                @include('inf.copy',['id'=>'name_i'])--}}
                                    {{--                            @endif--}}
                                </div>
                            </label>
                            @error('name_i') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    {{--скидки--}}
                    <div class="flex flex-row space-x-2">
                        <div class="mb-4 w-1/2">
                            {{--                            @permission('разработка')--}}
                            {{--                            discount--}}
                            {{--                            @endpermission--}}

                            <label class="block text-gray-700 text-sm">Акция для клиента (скидка):
                                {{--                            <sup--}}
                                {{--                                class="text-red-500">*</sup>--}}
                                <div class="relative">
                                    <input type="number" min="0" max="100" step="1" wire:model="discount"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                    >
                                    @if( !empty($discount) )
                                        @include('inf.copy',['id'=>'discount'])
                                    @endif
                                </div>
                            </label>
                            @error('discount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4 w-1/2">
                            <label class="block text-gray-700 text-sm">Комментарий для акции:<sup
                                    class="text-red-500">*</sup>
                                <div class="relative">
                                    <input type="text" wire:model="comment_akcia" id="comment_akcia"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                    >
                                    @if( !empty($name_i) )
                                        @include('inf.copy',['id'=>'comment_akcia'])
                                    @endif
                                </div>
                            </label>
                            @error('comment_akcia') <span
                                class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex-1">
                <div class="mb-4 flex flex-row space-x-2 items-center">
                    <div class="w-1/4">
                        <label class="block text-gray-700 text-sm">Тип оплаты:
                            <div class="relative">
                                <select wire:model.live="order_payment_type_id" id="order_payment_type_id"
                                        required>
                                    <option>- выбрать -</option>
                                    @foreach($payment_type as $i)
                                        <option value="{{$i['id']}}">{{$i['name']}}</option>
                                    @endforeach
                                </select>
                                {{--                                @if( !empty($client_id) )--}}
                                {{--                                    @include('inf.copy',['id'=>'order_payment_type_id'])--}}
                                {{--                                @endif--}}
                            </div>
                        </label>
                        @error('order_payment_type_id') <span
                            class="bg-red-100 p-1 text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    @if( !empty($price ) )
                        @foreach($payment_type as $i )
                            @if( $order_payment_type_id == $i['id'] )
                                @if( !empty($i['prepay']) )

                                    <div class="flex-1">
                                        <label class="block text-gray-700 text-sm">Сумма первой оплаты ( <a
                                                href="#"
                                                class="text-blue-400 underline"
                                                wire:click.prevent="$set('pay_one', {{ round($price/100*$i['prepay']) }})">{{ round($price/100*$i['prepay']) }}</a>
                                            ):
                                            <div class="relative">
                                                <input type="number" wire:model="pay_one"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                                                >
                                                {{--                                                    @if( !empty($name_i) )--}}
                                                {{--                                                        @include('inf.copy',['id'=>'name_i'])--}}
                                                {{--                                                    @endif--}}
                                            </div>
                                        </label>
                                        @error('name_i') <span
                                            class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    @if(1==2)
                                        <div class="mb-4">
                                            <label class="block text-gray-700">
                                                Первый платёж оплачен ?
                                                <input type="checkbox" wire:model="pay_one_payed" class="ml-2"/>
                                            </label>
                                            {{--                                        @error('urgently') <span--}}
                                            {{--                                            class="text-red-500 text-sm">{{ $message }}</span> @enderror--}}
                                        </div>
                                    @endif

                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>
@if(1==2)
                <div class="mb-4">
                    @permission('разработка')
                    $price_without_decor
                    @endpermission
                    <label class="block text-gray-700 text-sm"> Стоимость техники:
                        {{--                            <sup class="text-red-500">*</sup>--}}
                        <div class="relative">
                            <input type="text" wire:model="price_without_decor" id="price_without_decor"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                            >
                            @if( !empty($price_without_decor) )
                                @include('inf.copy',['id'=>'price_without_decor'])
                            @endif
                        </div>
                    </label>
                    @error('price_without_decor') <span
                        class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    @permission('разработка')
                    price_stone_countertop
                    @endpermission
                    <label class="block text-gray-700 text-sm">Стоимость камня:<sup
                            class="text-red-500">*</sup>
                        <div class="relative">
                            <input type="text" wire:model="price_stone_countertop"
                                   id="price_stone_countertop"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                            >
                            @if( !empty($price_stone_countertop) )
                                @include('inf.copy',['id'=>'price_stone_countertop'])
                            @endif
                        </div>
                    </label>
                    @error('price_stone_countertop') <span
                        class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    @permission('разработка')
                    design
                    @endpermission
                    <label class="block text-gray-700 text-sm">Дизайнер:<sup class="text-red-500">*</sup>
                        <div class="relative">
                            <input type="text" wire:model="design" id="design"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                            >
                            @if( !empty($name_i) )
                                @include('inf.copy',['id'=>'design'])
                            @endif
                        </div>
                    </label>
                    @error('design') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
@endif

            </div>


            {{--        нижняя кнопка--}}
            <div
                class="p-3 sticky bottom-0 bg-white/80 border-t transition-opacity duration-300"
                :class="{ 'opacity-100': isScrolled, 'opacity-0': !isScrolled }"
            >
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg чw-full">
                    Сохранить
                </button>

                @if( $return_url == 'leed' )
                    <span class="text-gray-500 p-1">
                ( после сохранения, переход в Лиды )
                        </span>
                @endif

                <!-- Сообщение об ошибке -->
                @if (session()->has('error'))
                    <span class="bg-red-100 text-red-800 p-2 rounded mb-4">{{ session('error') }}</span>
                @endif

            </div>
        </form>
        {{--        </div>--}}

        {{--        @if(1==2)--}}
        {{--            <div class="w-1/2">--}}

        {{--                <h2>--}}
        {{--                    Метки--}}
        {{--                </h2>--}}

        {{--                <div class="flex flex-row w-full space-x-3 px-3 mb-3">--}}
        {{--                    <div class="@if($modal_view1) w-1/2 @else w-1/4 @endif bg-gray-100 p-2">--}}
        {{--                        <livewire:cms2.order.order-label-block/>--}}
        {{--                    </div>--}}
        {{--                    <div class="@if($modal_view1) w-1/2 @else w-3/4 @endif">--}}
        {{--                        <div class="font-bold p-2">Метки заказа</div>--}}
        {{--                        @if( !empty($metki_show) )--}}
        {{--                            @foreach( $metki_show as $m )--}}
        {{--                                <span--}}
        {{--                                    class="border inline-block rounded mr-1 mb-1 py-1 pl-2 overflow-hidden bg-gray-100">--}}
        {{--                            {{ $m->name }}--}}
        {{--                                <sup><button class="text-red-100 hover:text-red-500 p-1 " title="удалить" type="button"--}}
        {{--                                             wire:click.prevent="metkaRemove({{$m->id}})">x</button></sup>--}}

        {{--                            </span>--}}
        {{--                            @endforeach--}}
        {{--                        @else--}}
        {{--                            << выберите метки--}}
        {{--                        @endif--}}
        {{--                    </div>--}}


        {{--                </div>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>
</div>
