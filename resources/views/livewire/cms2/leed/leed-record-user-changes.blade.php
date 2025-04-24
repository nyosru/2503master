<div>
    <div class="p-2 text-lg border-b ">
        {{--                    <div class="inline float-right">1 2 3</div>--}}
        <span class="font-bold">Ответсвенный за лид</span>
    </div>

    <div class="w-full text-sm max-h-[300px] overflow-auto flex flex-col space-y-1">
        {{--                    <pre>{{ print_r($leed->toArray()) }}</pre>--}}

        @if( $leed->userChanges  )
            @foreach( $leed->userChanges as $u )
                <div
                    class="px-2 pb-1 hover:bg-gray-100 @if(!empty($u->newUser->deleted_at)) line-through @endif flex flex-row items-center  ">
                    <div class="flex-1">{{$u->newUser->name}} ({{ $u->newUser->Roles[0]->name ?? '' }}
                        )
                    </div>
                    <span
                        class="w-[120px] text-center bg-gray-200">{{$u->created_at->format('H:i d.m.Y')}}</span>
                </div>
            @endforeach
        @endif

    </div>
</div>
