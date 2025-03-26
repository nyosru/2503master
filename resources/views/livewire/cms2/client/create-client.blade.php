<div>

    <style>
        .client-create h3 {    @apply bg-gray-100 rounded p-2 font-lg my-2
        }
        .client-create label {
            @apply block text-gray-700 text-sm
        }
        .client-create input[type=text] {
            @apply w-full border rounded-lg p-2
        }
        .client-create input[type=date] {
            @apply border rounded-lg p-2
        }
    </style>

    <div class="app-content-header"> <!--begin::Container-->
        <livewire:Cms2.App.Breadcrumb :menu="[
        ['route'=>'clients','name'=>'Клиенты'],
        [ 'link'=>'no', 'route'=>'clients.create','name'=>'Добавить клиента']
        ]"/>
    </div>

    <form wire:submit.prevent="save">
        <div class="container client-create">
            <div class="flex flex-row space-x-3">
                <div class="flex flex-col w-1/2">
                    <!-- Основные поля -->
                    <div>
                        <label>Фамилия:
                            <input type="text" id="name_f" wire:model="name_f" class="w-full border rounded-lg p-2">
                            @error('name_f') <span class="text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div>
                        <label>
                            Имя:
                            <input type="text" id="name_i" wire:model="name_i" class="w-full border rounded-lg p-2" required>
                            @error('name_i') <span class="text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div>
                        <label for="name_o">Отчество:</label>
                        <input type="text" id="name_o" wire:model="name_o" class="w-full border rounded-lg p-2">
                        @error('name_o') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone">Телефон:</label>
                        <input type="text" id="phone" wire:model="phone" class="w-full border rounded-lg p-2" required>
                        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" wire:model="email" class="w-full border rounded-lg p-2">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Доп. контакты:
                            <textarea wire:model="extra_contacts" class="w-full border rounded-lg p-2"></textarea>
                            @error('extra_contacts') <span class="text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div>
                        <label for="comment">Комментарий:</label>
                        <textarea id="comment" wire:model="comment" class="w-full border rounded-lg p-2"></textarea>
                        @error('comment') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="flex flex-col w-1/2">

                    <div>
                        <label>
                            Тип клиента:
                            <select wire:model.live="physical_person" class="block mb-2 p-2 border rounded w-full">
                                <option value="" selected>-- выберите --</option>
                                <option value="yes" selected>Физическое лицо</option>
                                <option value="no" selected>Юридическое лицо</option>
                            </select>
                        </label>
                    </div>

                    {{--                    <div>--}}
                    {{--                        <label for="address">Адрес:</label>--}}
                    {{--                        <input type="text" id="address" wire:model="address" class="w-full border rounded-lg p-2">--}}
                    {{--                        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror--}}
                    {{--                    </div>--}}

                    @if( !empty($physical_person ) )
                        <h3 class="bg-gray-100 rounded p-1 font-lg mb-2">
                            @if( $physical_person == 'yes' )
                                Регистрация (Прописка)
                            @elseif( $physical_person == 'no' )
                                Адрес
                            @endif
                        </h3>

                        <div>
                            <label for="city">Город:</label>
                            <input type="text" id="city" wire:model="city" class="w-full border rounded-lg p-2">
                            @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="street">Улица:</label>
                            <input type="text" id="street" wire:model="street" class="w-full border rounded-lg p-2">
                            @error('street') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        {{--                    адрес доп--}}
                        <div class="flex flex-row space-x-2">
                            <div>
                                <label for="building">Дом:</label>
                                <input type="text" id="building" wire:model="building"
                                       class="w-full border rounded-lg p-2">
                                @error('building') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="building_part">Корпус/Стр.:</label>
                                <input type="text" id="building_part" wire:model="building_part"
                                       class="w-full border rounded-lg p-2">
                                @error('building_part') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="cvartira">Квартира:</label>
                                <input type="text" id="cvartira" wire:model="cvartira"
                                       class="w-full border rounded-lg p-2">
                                @error('cvartira') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="floor">Этаж:</label>
                                <input type="text" id="floor" wire:model="floor" class="w-full border rounded-lg p-2">
                                @error('floor') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="lift">Лифт:</label>
                                <input type="checkbox" id="lift" wire:model="lift" class="border p-2">
                                @error('lift') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if( $physical_person == 'yes' )
                            {{--паспорт--}}
                            <h3 class="bg-gray-100 rounded p-1 font-lg mb-2">
                                Паспортные данные
                            </h3>

                            <div>
                                <label>Кем выдан:
                                    <input type="text" wire:model="passport">
                                    @error('passport') <span class="text-red-500">{{ $message }}</span> @enderror
                                </label>
                            </div>

                            <div>
                                <label>Когда выдан:
                                    <input type="date" wire:model="date_passport" class="border p-2">
                                    @error('date_passport') <span class="text-red-500">{{ $message }}</span> @enderror
                                </label>
                            </div>
                            {{--паспорт доп--}}
                            <div class="flex flex-row space-x-2">
                                <div>
                                    <label>Серия:
                                        <input type="text" wire:model="seria_passport" class="border p-2">
                                        @error('seria_passport') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                    </label>
                                </div>

                                <div>
                                    <label>Номер:
                                        <input type="text" wire:model="nomer_passport" class="border p-2">
                                        @error('nomer_passport') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                    </label>
                                </div>
                                <div>
                                    <label>Код подразделения:
                                        <input type="text" wire:model="cod_passport" class="border p-2">
                                        @error('cod_passport') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                    </label>
                                </div>


                            </div>

                        @elseif( $physical_person == 'no' )
                            {{--                    юрик--}}

                            <h3>
                                Данные юр лица
                            </h3>

                            <div>
                                <label>ur_passport:
                                    <input type="text" wire:model="ur_passport">
                                    @error('ur_passport') <span class="text-red-500">{{ $message }}</span> @enderror
                                </label>
                            </div>

                            <div>
                                <label>Название (кратко):
                                    <input type="text" wire:model="ur_name">
                                    @error('ur_name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </label>
                            </div>

                            <div>
                                <label>Название (полное):
                                    <input type="text" wire:model="name_company">
                                    @error('name_company') <span class="text-red-500">{{ $message }}</span> @enderror
                                </label>
                            </div>

                        @endif
                    @endif

                </div>

            </div>


            <div>
                <label for="building_part">Корпус/Строение:</label>
                <input type="text" id="building_part" wire:model="building_part"
                       class="w-full border rounded-lg p-2">
                @error('building_part') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Кнопка отправки -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Добавить клиента
                </button>
            </div>


        </div>
    </form>

    <!-- Уведомление об успешном создании -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</div>
