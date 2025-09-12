<div class="flex flex-col  text-center">

    @if(session('error_all'))
        <div class="bg-gradient-to-tr to-red-100 from-red-500 text-white p-4 rounded mb-4 shadow-lg">
            {{ session('error_all') }}
        </div>
    @else

        <livewire:board.leed.item-mini-move-leed-form :board_id="$board_id" :leed="$leed"/>
        <livewire:board.leed.item-mini-comment-form :leed="$leed"/>

    @endif

</div>
