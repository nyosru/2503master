<div>
    <div class="h-[300px] overflow-y-auto p-2">
        @foreach($items as $c )
            <div class=" hover:bg-gray-200 p-1 text-sm" style="border-bottom: solid #efefef 1px;">
                <span class="text-black/50 float-right">
                    {{ date('d.m.Y H:i',strtotime($c->created_at)) }}
                    </span>
                {!! str_replace('/','<br/>',$c->comment) !!}<br/>
            </div>
        @endforeach
    </div>
</div>
