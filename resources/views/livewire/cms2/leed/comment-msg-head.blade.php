<div>

{{--        <pre class="text-xs max-h-[100px] overflow-auto">{{ print_r($this->comment->toArray()) }}</pre>--}}

    <div class="flex flex-col space-y-1">
        <div
            class="text-sm @if( !empty($comment->user->deleted_at) ) line-through @endif
                  @if( $thisAutor )
                  text-right
                  @else
                  @endif
            ">

            {{ $comment->user->name ?? '' }} ({{ $comment->user->roles[0]->name ?? '' }})

            <span title="{{ date('d.m.Y H:i',strtotime( $comment->created_at ) ) }}"
                  class="
{{--                  xtext-xs --}}
                  text-gray-500
                  @if( $thisAutor )
                   float-left mr-2
                  @else
                 float-right ml-2
                  @endif
                  ">{{
//    $comment->created_at->diffForHumans()
    $comment->created_at->format('H:i d.m.Y')
    }}</span>

            @permission('разработка')
            <button wire:click="deleteComment({{ $comment->id }})"
                    class="text-red-500 mx-2
{{--                    xtext-sm --}}
                    float-right">
                x
            </button>
            @endpermission

        </div>

        <div class="w-full flex
            @if( $thisAutor )
            flex-row-reverse
             @else
            flex-row
            @endif
        ">

            <div class="w-[50px] px-2 text-center">
                <img src="/icon/user.png" class="w-[36px]">
            </div>
            <div class="flex-1">
                {{--коментарий файлы--}}
                <div
                    class="border  rounded p-1
                        @if( Auth::id() != $comment->user->id ) border-1 border-gray-600 bg-gray-200
                        @else border-2 border-blue-200 bg-white
                        @endif
                        ">

                    @if( !empty($comment->addressedToUser->id) )
                        <div style="margin-left: -3px; margin-top:-6px;">
                            <span class="text-xs p-1 text-blue-400">
                                <svg class="inline h-4 w-4 text-blue-400" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path
                                        d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/></svg>
                                 {{$comment->addressedToUser->name}}
                                @if( !empty($comment->addressedToUser->Roles[0]->name) )
                                    <sup>({{$comment->addressedToUser->Roles[0]->name}})</sup>
                                @endif
                            </span>
                        </div>
                    @endif

                    {{ $comment->comment }}

                    @if ($comment->files->isNotEmpty())
                        <div class="mt-1">
                            @foreach ($comment->files as $f)
                                @if(!empty($f->mini))
                                    <a href="{{ asset('storage/' . $f->path) }}" target="_blank">
                                        <img src="{{ asset('storage/' .$f->mini) }}"
                                             class="w-[50px] m-1 inline"/>
                                    </a>
                                @endif
                            @endforeach
                            <div class="
                                w-full
                                overflow-auto">

                                @foreach ($comment->files as $f)
                                    @if(empty($f->mini))
                                        <a
                                            href="{{ strpos($f->path,'https://') !== false ? $f->path : asset('storage/' . $f->path)  }}"
                                            target="_blank"
                                            class="
{{--                                           text-sm --}}
                                           text-xs
                                           text-blue-600 hover:underline"
                                            title="{{ $f->file_name }}"
                                        >
                                            @if( pathinfo($f->path, PATHINFO_EXTENSION) == 'pdf' )
                                                <img src="/icon/file/pdf.png" class="w-[32px] inline" alt="" border=""/>
                                            @elseif( pathinfo($f->path, PATHINFO_EXTENSION) == 'jpg' )
                                                <img src="/icon/file/jpg.svg" class="w-[32px] inline" alt="" border=""/>
                                            @elseif( pathinfo($f->path, PATHINFO_EXTENSION) == 'zip' )
                                                <img src="/icon/file/zip.png" class="w-[32px] inline" alt="" border=""/>
                                            @elseif( pathinfo($f->path, PATHINFO_EXTENSION) == 'mp4' )
                                                <img src="/icon/file/mp4.png" class="w-[32px] inline" alt="" border=""/>
                                            @else
                                                <span class="inline-block w-[10px] h-[10px] bg-blue-500 mr-2"></span>
                                            @endif
                                            @if( strlen($f->file_name) > 50 )
                                                {{ mb_substr($f->file_name,0,25) }}...{{ mb_substr($f->file_name,-7) }}
                                            @else
                                                {{ $f->file_name }}
                                            @endif
                                            {{--                                            <br/>--}}
                                            {{--                                            {{$f->path}}--}}
                                        </a>

                                        {{--                                        <br/>--}}
                                        <br/>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    @endif

                </div>


                @if( !$thisAutor )
                    <div class="text-right">

                        {{--                        readed: {{ $comment->readed }}--}}
                        @if(!$comment->readed && $user_up == Auth::id() )
                            <button type="button"
                                    wire:click="setReadedComment({{$comment->id}})"
                                    class="hover:underline text-blue-500">прочитано
                            </button>
                        @endif

                        @if( empty($comment->parent_id) )
                            <button type="button"
                                    class="hover:underline text-blue-500"
                                    wire:click="reply({{ $comment->id }})"
                            >ответить
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="ml-[10%] w-[90%]">
        @if(!$comment->childComments->isEmpty())
            @foreach($comment->childComments as $cc )
                <div class="flex flex-col space-y-1">
                    <livewire:cms2.leed.comment-msg-head :user_up="$comment->user_id" :comment="$cc"/>
                </div>
            @endforeach
        @endif
    </div>

</div>
