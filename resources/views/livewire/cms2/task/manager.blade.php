<div class="p-4 bg-white shadow sm:rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Менеджер задач</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-500">{{ session('message') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('task.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Добавить задачу</a>
    </div>

    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Название задачи</th>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Комментарий</th>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Дата выполнения</th>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Время выполнения</th>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Ответственный</th>
                <th class="px-4 py-2 text-sm font-medium text-gray-500">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $task->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $task->comment }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $task->date }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $task->time }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $task->lead ? $task->lead->name : 'Не указан' }}</td>
                    <td class="px-4 py-2 text-sm">
                        <a href="{{ route('task.create', ['taskId' => $task->id]) }}" class="text-indigo-600 hover:text-indigo-800">Редактировать</a>
                        <button wire:click="deleteTask({{ $task->id }})" class="text-red-600 hover:text-red-800 ml-4">Удалить</button>
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
