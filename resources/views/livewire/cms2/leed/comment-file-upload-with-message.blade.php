<div>

    $this->leed_record_id: {{ $this->leed_record_id }}
    <br/>
    CommentFileUploadWithMessage
    <br/>

    <form wire:submit.prevent="submit">

        <!-- Сообщение -->
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Ваше сообщение</label>
            <textarea wire:model="message" id="message" rows="4" class="w-full p-2 mt-2 border rounded"
                      placeholder="Введите сообщение..."></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Файлы -->
        {{--        <div class="mb-4">--}}
        {{--            <label for="files" class="block text-sm font-medium text-gray-700">Выберите файлы</label>--}}
        {{--            <input type="file" wire:model="files" id="files" multiple class="w-full p-2 mt-2 border rounded">--}}
        {{--            @error('files.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror--}}
        {{--        </div>--}}

        {{--        <form wire:submit="save">--}}
        {{--            @if ($files)--}}
        {{--        @if ($files)--}}
        {{--            @foreach($files as $file)--}}
        {{--                <img src="{{ $file->temporaryUrl() }}">--}}
        {{--            @endforeach--}}
        {{--        @endif--}}
        $uploadedFiles: {{ print_r($uploadedFiles ?? ['x'] ) }}
        <input type="file" multiple wire:model="ffiles"/>
        @error('ffiles.*') <span class="error">{{ $message }}</span> @enderror

        {{--            <button type="submit">Save photo</button>--}}
        {{--        </form>--}}

        {{--        <!-- Список выбранных файлов -->--}}
        {{--        <div class="mb-4">--}}
        {{--            @if($files)--}}
        {{--                <h3 class="text-sm font-medium">Выбраны файлы:</h3>--}}
        {{--                <ul class="list-disc pl-5 mt-2">--}}
        {{--                    @foreach($files as $file)--}}
        {{--                        <li>{{ $file->getClientOriginalName() }} ({{ $file->getSize() }} bytes)</li>--}}
        {{--                    @endforeach--}}
        {{--                </ul>--}}
        {{--            @endif--}}
        {{--        </div>--}}

        <!-- Кнопка отправки -->
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Отправить</button>
    </form>

    <!-- Сообщение об успешной отправке -->
    @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
</div>
