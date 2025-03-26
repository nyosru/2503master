<div>


    @if (session()->has('errorOtkazReason'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('errorOtkazReason') }}
        </div>
    @endif

    @if (session()->has('messageOtkazReason'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('messageOtkazReason') }}
        </div>
    @else
        <form class="my-3 relative bg-blue-500/30 p-1"
{{--              wire:submit="sendReason({{$recordId}})"--}}
              wire:submit="sendReason"
        >

{{--            @permission('разработка')--}}
{{--            $recordId: {{$recordId}}--}}
{{--            <br/>--}}
{{--            @endpermission--}}

            <textarea
                id="reason-{{ $recordId }}"
                class="w-full mt-1 border rounded"
                placeholder="Какая причина отказа?"
                wire:model="reason"></textarea>

            <div class="text-center mt-2">
                <button
                    type="submit"
                    class="bg-blue-500 px-3 py-1 rounded text-white hover:bg-blue-700">
                    Отправить
                </button>
            </div>

        </form>
    @endif

</div>
