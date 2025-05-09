<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.logs','name'=>'Логи'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    {{--    <h2 class="text-xl font-bold mb-4">Логи</h2>--}}

    <div class="max-w-[877px]">
        <form wire:submit.prevent="applyFilters">
            <div class="justify-center flex space-x-4 mb-4">
                {{--        <input type="text" wire:model.defer="filters.user_id" placeholder="ID пользователя"--}}
                {{--               class="border p-2 rounded">--}}
                <!-- User ID -->
                <div class="w-4/12">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Пользователь:</label>
                    <select wire:model.defer="filters.user_id" id="user_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Все пользователи</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->id }} \ {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{--            <input type="text" wire:model.defer="filters.order_id" placeholder="ID заказа"--}}
                {{--               class="border p-2 rounded">--}}

                <!-- Order ID -->
                <div class="w-4/12">
                    <label for="order_id" class="block text-gray-700 text-sm font-bold mb-2">Заказ:</label>
                    <select wire:model.defer="filters.order_id" id="order_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Все заказы</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->id }} \ {{ $order->name }}</option>
                        @endforeach
                    </select>
                </div>


                {{--            <input type="text" wire:model.defer="filters.leed_record_id" placeholder="ID лида"--}}
                {{--               class="border p-2 rounded">--}}

                <!-- Leed Record ID -->
                <div class="w-4/12">
                    <label for="leed_record_id" class="block text-gray-700 text-sm font-bold mb-2">Лид:</label>
                    <select wire:model.defer="filters.leed_record_id" id="leed_record_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Все лиды</option>
                        @foreach($leedRecords as $leedRecord)
                            <option value="{{ $leedRecord->id }}">{{ $leedRecord->id }}
                                \ {{ $leedRecord->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">&nbsp;</label>
                    <button
                        {{--            wire:click="applyFilters" --}}
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        Фильтровать
                    </button>
                </div>
            </div>
        </form>

        <table class="w-full border-collapse border">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Пользователь</th>
                <th class="border p-2">Запись</th>
                <th class="border p-2">Заказ</th>
                <th class="border p-2">Лид</th>
                <th class="border p-2">Дата</th>
                <th class="border p-2">Данные</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr class="border {{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="border p-2">{{ $log->id }}</td>
                    <td class="border p-2 @if($log->user->deleted_at) line-through @endif ">
                        {{ $log->user->name }}
                        <sup>{{ $log->user_id }}</sup>
                    </td>
                    <td class="border p-2">{{ str_replace('/','<br/>',$log->comment) }}</td>
                    <td class="border p-2">{{ $log->order_id ?? '—' }}</td>
                    <td class="border p-2">{{ $log->leed_record_id ?? '—' }}</td>
                    <td class="border p-2">{{ $log->created_at }}</td>
                    <td class="border p-2">{{ json_encode($log->data, JSON_PRETTY_PRINT) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $logs->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
</div>
