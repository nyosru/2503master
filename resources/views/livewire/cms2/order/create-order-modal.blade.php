<div>
    <!-- Модальное окно -->
    <div class="fixed inset-0 overflow-y-auto"
         style="z-index: 15; "
         aria-labelledby="modal-title" role="dialog" aria-modal="true"
         x-show="open"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                 x-on:click="$wire.closeModal()"></div>

            <!-- Центрируем контент модального окна -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all

                    w-[500px]
                    sm:w-1/2

                    xlg:w-1/2
                    xsm:my-8s
                    xsm:align-middle
                    xsm:max-w-lg
                    xsm:w-full
                    "
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 relative">

                    {{--                    шапка--}}
                    <div class="sticky top-0 bg-white z-15">
                        <a href="{{ route('leed') }}"
                           wire:navigate
                           {{--                           type="button"--}}
                           class="float-right mt-3 w-full inline-flex justify-center px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            {{--                            x-on:click="$wire.closeModal()"--}}
                            {{--                                @click="open = false"--}}
                        >
                            Х
                        </a>
                        <h3 class="text-lg leading-6 font-medium text-gray-900
                    " id="modal-title">
                            Создание заказа
                        </h3>
                    </div>
                </div>
                {{--                <div style="height: calc(100vh - 30мр60px); overflow-y:auto;">--}}
                {{--                <div style="height: 70vh; overflow-y:auto;">--}}
                <div>
                    <div class="mt-2">

                        @if(1==2)
                            record_id: {{ $record_id ?? 'x' }}<br/>
                            client_to_order_id: {{ $client_to_order_id ?? 'x' }}<br/>
                            modal_view: {{ $modal_view ?? 'x' }}<br/>
                            return_url: {{ $return_url ?? 'x' }}<br/>
                        @endif

                        <livewire:cms2.order.OrderCreate wire:lazy key="m2cor{{$record_id}}"
                                                         :client_to_order_id="$client_to_order_id"
                                                         :modal_view="true"
                                                         :return_url="$return_url"
                                                         :return_leed="$record_id"
                        />


                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
