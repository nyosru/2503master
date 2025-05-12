<div class="p-2">

    <div class=" text-lg border-b ">
        {{--                    <div class="inline float-right">1 2 3</div>--}}
        <span class="font-bold">Файлы</span>
    </div>

    {{--    <pre class="text-xs" >{{ print_r($files->toArray()) }}</pre>--}}
    {{--    файлы / папки--}}
    {{--    <Br/>--}}
    {{--    <br/>--}}
    {{--    <br/>--}}

    <div class="max-h-[360px] overflow-auto w-full p-2">
        @foreach( $files as $k =>$f )
            <div class="@if( $k % 2 ) bg-white @else bg-gray-100 @endif  p-2">
                <div class="text-xs">
                    <span class="text-xs float-right">{{ $f->created_at->format('d.m.Y H:i') }}</span>
                    {{ $f->user->name ?? '-' }}
                </div>
                <div class="ml-5">

                    @if( !empty($f->name) )
                        {{ $f->name }}<br/>
                    @endif

                    {{--                    <pre>{{ print_r($f) }}</pre>--}}
                    <a
                        @php
                            //                                $extension = pathinfo($f->file_name, PATHINFO_EXTENSION);
                                                            $extension = strtolower(pathinfo($f->path, PATHINFO_EXTENSION));
                            //                                $mime = mime_content_type($f->file_name);
                        @endphp
                        @if( $extension == 'jpg' )
                            target="_blank"
                        href="{{ $f->path }}"
                        @else
                            href="{{ route('download.file', [ 'id' => $f->id, 'file_name' => $f->file_name ]) }}"
                        @endif
                        class="text-blue-500 underline"
                    >
                        {{ $f->file_name }}
                    </a>


                </div>
                {{--            {{ $f->path }}<br/>--}}
                {{--            <br/>--}}
                {{--            <br/>--}}
            </div>
        @endforeach
    </div>
    {{--    <livewire:cms2.leed.leed-comment-add :leed_record_id="$leed_record_id"/>--}}
    {{--    :board_id="{{$board_id}}"--}}
    <livewire:file.add-form
        :board_id="$board_id"
        :leed_record_id="$leed->id"
    />
</div>

