<div class="flex flex-col text-center">
    <div class="font-bold text-xl my-4 ">
        Добавить комментарий:
    </div>

    @if(session('success_add_comment'))
        <div class="bg-green-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('success_add_comment') }}
        </div>
    @endif

    @if(session('error_add_comment'))
        <div class="bg-red-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('error_add_comment') }}
        </div>
    @endif

    <div>
        <form wire:submit.prevent="addComment">
            <div class="flex flex-col items-center space-y-1">
                <div>
                    <textarea
                        class="min-w-[300px] w-full border border-gray-300 rounded p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        wire:model="comment_now"
                        placeholder="Введите ваш комментарий..."
                        rows="3"
                    ></textarea>
                    @error('comment_now')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button
                        type="submit"
                        class="bg-gradient-to-tr from-blue-500 to-blue-600 text-white p-2 px-4 rounded shadow-lg hover:from-blue-600 hover:to-blue-700 transition duration-200"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Добавить</span>
                        <span wire:loading>Добавление...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
