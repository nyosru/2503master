<div>
    <div class="h-[300px] overflow-y-auto p-2">
        @php
            $lastDate = null;
        @endphp

        @foreach($items as $c)
            @php
                $currentDate = date('Y-m-d', strtotime($c->created_at));
                $currentTime = date('H:i', strtotime($c->created_at));
            @endphp

            <div class="hover:bg-gray-200 p-1 text-sm" style="border-bottom: solid #efefef 1px;">
                <span class="text-black/50 float-right">
                    @if ($lastDate !== $currentDate)
                        {{ date('d.m.Y H:i', strtotime($c->created_at)) }}
                        @php $lastDate = $currentDate; @endphp
                    @else
                        {{ $currentTime }}
                    @endif
                </span>
                {!! str_replace('/', '<br/>', $c->comment) !!}
            </div>
        @endforeach
    </div>
</div>

