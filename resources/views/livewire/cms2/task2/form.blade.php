<div class="p-6 bg-white rounded-lg shadow-md">

    <div class="app-content-header">
        <livewire:Cms2.App.Breadcrumb :menu="[
            ['route'=>'tech.index','name'=>'Техничка'],
            ['route'=>'tech.task2','name'=>'Задачи'],
            ['link'=>'no','name'=>( isset($task) ? 'Редактировать задачу №'.$task->id : 'Создать задачу' )],
        ]"/>
    </div>

    <div class="w-[600px]">
        {{--    <h2 class="text-xl font-semibold mb-4">--}}
        {{--        {{ isset($task) ? 'Редактировать задачу' : 'Создать задачу' }}--}}
        {{--    </h2>--}}

        @if (session()->has('message'))
            <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Название</label>
                <input type="text" id="name" wire:model="taskData.name" class="w-full p-2 border rounded">
                @error('taskData.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Описание</label>
                <textarea id="description" wire:model="taskData.description"
                          class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="autor_id" class="block text-gray-700">Кто назначил</label>
                <select id="autor_id" wire:model="taskData.autor_id" class="w-full p-2 border rounded">
                    <option value="">Выберите пользователя</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('taskData.autor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="worker_id" class="block text-gray-700">Кому назначено</label>
                <select id="worker_id" wire:model="taskData.worker_id" class="w-full p-2 border rounded">
                    <option value="">Выберите пользователя</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('taskData.worker_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="start_at" class="block text-gray-700">Дата и время начала</label>
                <input type="datetime-local" id="start_at" wire:model="taskData.start_at"
                       class="w-full p-2 border rounded">
                @error('taskData.start_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="due_at" class="block text-gray-700">Дата и время выполнения</label>
                <input type="datetime-local" id="due_at" wire:model="taskData.due_at" class="w-full p-2 border rounded">
                @error('taskData.due_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if( empty($taskData['order_id']) )
                <div class="mb-4">
                    <label for="leed_record_id" class="block text-gray-700">Лид</label>
                    <select id="leed_record_id" wire:model.live="taskData.leed_record_id"
                            class="w-full p-2 border rounded">
                        <option value="">Не указан</option>
                        @foreach($leedRecords as $leed)
                            <option value="{{ $leed->id }}">{{ $leed->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if( empty($taskData['leed_record_id']) )
                <div class="mb-4">
                    <label for="order_id" class="block text-gray-700">Заказ</label>
                    <select id="order_id" wire:model.live="taskData.order_id" class="w-full p-2 border rounded">
                        <option value="">Не указан</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="viewed" wire:model="taskData.viewed" class="mr-2">
                <label for="viewed" class="text-gray-700">Просмотрено</label>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="completed" wire:model="taskData.completed" class="mr-2">
                <label for="completed" class="text-gray-700">Выполнено</label>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="approved" wire:model="taskData.approved" class="mr-2">
                <label for="approved" class="text-gray-700">Результат принят</label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
