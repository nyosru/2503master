<div>

    <div class="app-content-header">
        <livewire:Cms2.App.Breadcrumb :menu="[
            ['route'=>'tech.index','name'=>'Техничка'],
            ['route'=>'tech.task2','name'=>'Задачи'],
{{--            ['link'=>'no','name'=>'Заказ #'.$order_id],--}}
        ]"/>
    </div>

    <div class="p-4 bg-white shadow sm:rounded-lg">
        {{--        <h2 class="text-2xl font-semibold mb-4">Менеджер задач</h2>--}}

        @if (session()->has('message'))
            <div class="mb-4 text-green-500">{{ session('message') }}</div>
        @endif

        <div class="mb-4">
            <a href="{{ route('tech.task2.form') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Добавить задачу</a>
        </div>

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Название задачи</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Комментарий</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">ДВ Старт</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">ДВ ДедЛайн</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Автор</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Исполнитель</th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Лид</br>
                        Заказ
                    </th>
                    <th class="px-4 py-2 text-sm font-medium text-gray-500">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->description ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->start_at ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->due_at ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->autor_id ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $task->worker_id ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ $task->lead ? $task->lead->name : '-' }}
                            <br/>
                            {{ $task->order_id ? $task->order->name : '-' }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <a href="{{ route('tech.task2.form', ['task_id' => $task->id]) }}"
                               class="text-indigo-600 hover:text-indigo-800">Редактировать</a>
                            <button wire:click="deleteTask({{ $task->id }})"
                                    class="text-red-600 hover:text-red-800 ml-4">Удалить
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>


</div>
