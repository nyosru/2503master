<div class="flex-col space-y-1 ">
    <div class="xbg-gray-200 px-2 text-sm @if( !empty($user->deleted_at) ) line-through @endif">
        {{ $user->name ?? '' }} ({{ $user->roles[0]->name ?? '' }})
        <span class="float-right text-gray-600">
            @if( !empty($at) )
                {{ date('H:i d.m.Y', strtotime($at) ) }}
            @endif
            </span>
    </div>
    {{--        <br clear="all"/>--}}
    <div class="flex @if($thisAutor) flex-row-reverse @else flex-row @endif ">
        <div class="w-[34px] text-center">
            <img src="/icon/user.png" class="w-[30px]">
        </div>
        <div class="flex-1">
            <div
                class="rounded p-1 border @if($thisAutor) bg-white border-blue-500 @else bg-gray-200 border-gray-500  @endif ">
                {{ $msg }}
            </div>
        </div>
    </div>
</div>
