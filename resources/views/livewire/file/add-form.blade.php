<div
    {{--    class="h-[100px]"--}}
    x-data="{ uploading: false, progress: 0 , fileCount: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false; progress = 0;"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>

{{--    leed_record_id: {{ $leed_record_id }}--}}
    {{--    добавить комент--}}

    {{--добавили комент--}}
    @if (session()->has('messageFileAdd'))
                <div class="bg-green-500 text-white p-2 mb-4">
                    {{ session('messageFileAdd') }}
                </div>
{{--                <script>--}}
{{--                    document.getElementById('scrollable-block').scrollTop = document.getElementById(--}}
{{--                        'scrollable-block').scrollHeight + 500;--}}
{{--                </script>--}}
    @endif

    <form wire:submit="addFile({{$leed_record_id}})"
          {{--          x-show="show_form"--}}
          {{--          x-data="fileUploader()"--}}
          id="message"
          {{--          @file-selected.window="handleFiles($event.detail)"--}}
          @open-reply-form.window="openReplyForm($event.detail)"
    >

        <input type="hidden"
               wire:model="parentCommentId"
        >

        <div class="flex flex-col space-y-1">
            @if( !empty($parentCommentId))
                <div>
                    <span> ответ на сообщение </span>
                    <button wire:click="$set('parentCommentId',null)"
                            class="text-red-300 hover:text-red-600 hover:underline"> х
                    </button>
                </div>
            @endif


            <div class="flex flex-row"
            >
                <div class="flex-1">

            <input id="name" wire:model="name" placeholder="название"
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       />

                    @error('fi.*') <span class="text-red-500 text-xs">
                        @if( $message == 'validation.uploaded' )
                            Ошибка загрузки: обновите страницу и заново выберите файлы для загрузки
                        @else
                            ошибка файлов: {{ $message }}
                        @endif
                    </span> @enderror


                </div>
                <div class="w-[60px] text-center"

                >
                    <label>

                        {{--                        <span title="файлов выбрано" class="mt-2 text-gray-700 " x-show="fileCount>0"><svg class="inline h-6 w-6 text-gray-700"  fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
                        {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"/>--}}
                        {{--                        </svg> <span x-text="fileCount"></span></span>--}}

                        {{--                        <img src="/icon/screpka.png" class="ml-2"/>--}}
                        <div class="flex flex-row items-center">
                            <div>
                                <svg class="mx-auto pt-2 h-10 w-10 text-blue-500" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path
                                        d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                                </svg>
                            </div>
                            <div class="text-gray-400 tex-sm">
                                <span x-show="fileCount>0" x-text="fileCount"></span>
                            </div>
                        </div>
                        <input type="file"
                               wire:model="fi"
                               id="fileInputComment"
                               @change="fileCount = $event.target.files.length"
                               multiple
                               class="hidden"/>
                    </label>

                    {{--                    <div class="">--}}
                    <div x-show="uploading" class="mt-1 flex flex-col ">

                        <progress max="100" x-bind:value="progress"
                                  class="w-full h-[5px] bg-blue-500 overflow-y-hidden"></progress>
                        <span class="text-xs" x-text="progress + '%'"></span>
                        {{--                        </div>--}}
                    </div>
                    {{--                    </div>--}}
                    {{--                    <script>--}}

                    {{--                        // Получаем элементы--}}
                    {{--                        const fileInput = document.getElementById('fileInputComment');--}}
                    {{--                        const fileCountDisplay = document.getElementById('fileInputComment');--}}

                    {{--                        // Добавляем обработчик события "change"--}}
                    {{--                        fileInput.addEventListener('change', function () {--}}
                    {{--                            const fileCount = fileInput.files.length; // Получаем количество выбранных файлов--}}
                    {{--                            fileCountDisplay.textContent = `Выбрано файлов: ${fileCount}`; // Обновляем текст--}}
                    {{--                        });--}}
                    {{--                    </script>--}}
                </div>
                {{--            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror--}}

            </div>


            {{--кому отправить и кнопка отправить--}}
            <div class="flex flex-row items-center space-x-2">
                {{--                <div--}}
                {{--                    class="w-full flex flex-row"--}}
                {{--                >--}}
                <div class="w-[50px] px-2 text-center">
                    @if(1==2)
                    <img src="/icon/user.png" class="w-[36px]">
                    @endif
                </div>
                <div class="flex-1">
                    @if(1==2)
                    <select class="w-full rounded p-1" wire:model="addressed_to_user_id">
                        <option value="">--</option>
                        @if(!empty($users))
                            @foreach($users as $user)
                                @if($user->id != Auth::id() )
                                    <option value="{{ $user->id }}"
                                            title="в crm -> {{ $user->staff->name ?? '' }} ({{ $user->staff->department ?? '' }})"
                                    >{{ $user->name ?? ''}}
                                        @foreach($user->roles as $role)
                                            ({{ $role->name ?? ''}})
                                            @break
                                        @endforeach
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    @endif
                </div>

                <div class="w-[100px] text-center xpt-3
">
                    <button type="submit"
                            x-show="!uploading"
                            class="bg-blue-500 text-white px-3 py-1 rounded-md">Добавить
                    </button>
                    <span x-show="uploading" class="text-gray-500">Загрузка...</span>
                </div>
                {{--                </div>--}}

            </div>
        </div>
    </form>
</div>

