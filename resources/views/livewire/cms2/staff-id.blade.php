<div>
    <div class="container mx-auto">

        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-4">

                        <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'staff.index','name'=>'Сотрудники']]"/>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>
                    <table>
                        <tr>

                            {{--                <th scope="col" style="text-align: center"></th>--}}
                            {{--                </th>--}}

                            <th scope="col">
                                {{--                    department--}}
                                Должность
                            </th>
                            <th scope="col">
                                {{--                    name--}}
                                ФИО
                            </th>
                            <th scope="col">
                                {{--                    phone--}}
                                Телефон
                            </th>
                            <th scope="col">
                                {{--                    email--}}
                                E-mail
                            </th>
                            <th scope="col">
                                Д.Р.
                                {{--                    date--}}
                            </th>
                            @if( $show_all_info )
                                <th scope="col">telegram_chat_id</th>
                                <th scope="col">have_telegram_access</th>
                                <th scope="col">have_crm_access</th>
                                <th scope="col">address</th>
                                <th scope="col">is_chief</th>
                                <th scope="col">is_manager</th>
                                <th scope="col">access_table</th>
                                <th scope="col">access_regedit</th>
                                <th scope="col">access_leads</th>
                                <th scope="col">access_accounting</th>
                                <th scope="col">access_schedule</th>
                                <th scope="col">access_contracts</th>
                                {{--                <th scope="col">password</th>--}}
                                {{--                <th scope="col">access_key</th>--}}
                                <th scope="col">status</th>
                                <th scope="col">access_orders</th>
                                <th scope="col">access_clients</th>
                                <th scope="col">access_staff</th>
                                <th scope="col">access_providers</th>
                                <th scope="col">access_warehouse</th>
                                <th scope="col">access_supply</th>
                                <th scope="col">access_services</th>
                                <th scope="col">role</th>
                                <th scope="col">style</th>
                                <th scope="col">menu</th>
                                <th scope="col">avatar</th>
                                <th scope="col">config</th>
                                <th scope="col">access_orders_all</th>
                                <th scope="col">access_files</th>
                                <th scope="col">access_fittings</th>
                                <th scope="col">access_tfmf</th>
                            @endif
                        </tr>
                        @if(1==2)
                            <tr>


                                <td>{{ $i->department ?? '-' }}


                                </td>
                                <td>

                                    {{--                            @if( !empty($i->date) )--}}
                                    {{--                                @if(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($i->date)) <= 14 && Carbon\Carbon::now()->lt(Carbon\Carbon::parse($i->date)))--}}
                                    {{--                                    <div class="inline float-right p-1 bg-warning">Скоро ДР!</div>--}}
                                    {{--                                @endif--}}
                                    {{--                            @endif--}}

                                    {{ $i->name ?? '-' }}


                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                        Launch demo modal
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @if( !empty($i->date) )
                                        @php
                                            $currentDate = Carbon\Carbon::now()->setYear(2000);
                                             $birthday = Carbon\Carbon::parse($i->date)->setYear(2000);
                                             $daysUntilBirthday = $currentDate->diffInDays($birthday);
                                            $currentDate1 = Carbon\Carbon::now();
                                             $birthday1 = Carbon\Carbon::parse($i->date);
                                             $yearsUntilBirthday = $birthday1->diffInYears($currentDate1) +1 ;
                                        @endphp

                                        @if( $daysUntilBirthday <= 14 && $currentDate->lt($birthday))
                                            <span class="inline float-right p-1 bg-warning">Скоро ДР! <b><abbr
                                                        title="Исполняется {{ (int) $yearsUntilBirthday }}">{{ (int) $yearsUntilBirthday }}</abbr></b></span>
                                        @endif
                                    @endif


                                </td>
                                <td>{!! $i->phone ? '<a href="tel:'.$i->phone.'" >'.$i->phone.'</a>' : '-' !!}</td>
                                <td>
                                    @if( !empty( $i->email ) )
                                        <A href="mailto:{{ $i->email }}">{{ $i->email }}</A>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $i->date ?? '-' }}</td>
                                @if( $show_all_info )
                                    <td>{{ $i->telegram_chat_id ?? '-' }}</td>
                                    <td>{{ $i->have_telegram_access ?? '-' }}</td>
                                    <td>{{ $i->have_crm_access ?? '-' }}</td>
                                    <td>{{ $i->address ?? '-' }}</td>
                                    <td>{{ $i->is_chief ?? '-' }}</td>
                                    <td>{{ $i->is_manager ?? '-' }}</td>
                                    <td>{{ $i->access_table ?? '-' }}</td>
                                    <td>{{ $i->access_regedit ?? '-' }}</td>
                                    <td>{{ $i->access_leads ?? '-' }}</td>
                                    <td>{{ $i->access_accounting ?? '-' }}</td>
                                    <td>{{ $i->access_schedule ?? '-' }}</td>
                                    <td>{{ $i->access_contracts ?? '-' }}</td>
                                    {{--                        <td>{{ $i->password ?? '-' }}</td>--}}
                                    {{--                        <td>{{ $i->access_key ?? '-' }}</td>--}}
                                    <td>{{ $i->status ?? '-' }}</td>
                                    <td>{{ $i->access_orders ?? '-' }}</td>
                                    <td>{{ $i->access_clients ?? '-' }}</td>
                                    <td>{{ $i->access_staff ?? '-' }}</td>
                                    <td>{{ $i->access_providers ?? '-' }}</td>
                                    <td>{{ $i->access_warehouse ?? '-' }}</td>
                                    <td>{{ $i->access_supply ?? '-' }}</td>
                                    <td>{{ $i->access_services ?? '-' }}</td>
                                    <td>{{ $i->role ?? '-' }}</td>
                                    <td>{{ $i->style ?? '-' }}</td>
                                    <td>{{ $i->menu ?? '-' }}</td>
                                    <td>{{ $i->avatar ?? '-' }}</td>
                                    <td>{{ $i->config ?? '-' }}</td>
                                    <td>{{ $i->access_orders_all ?? '-' }}</td>
                                    <td>{{ $i->access_files ?? '-' }}</td>
                                    <td>{{ $i->access_fittings ?? '-' }}</td>
                                    <td>{{ $i->access_tfmf ?? '-' }}</td>
                                @endif

                            </tr>
                        @endif


                    </table>
                </div>
                <!-- Pagination links -->

                {{--    @ include('livewire.cms2.buh-pagination') --}}
                {{ $items->onEachSide(2)->links('livewire.cms2.any-pagination') }}


                {{--    <!-- Modal -->--}}
                {{--    <div class="modal fade" id="staffInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                {{--        <div class="modal-dialog modal-xl">--}}
                {{--            <div class="modal-content">--}}
                {{--                <div class="modal-header">--}}
                {{--                    <h5 class="modal-title" id="exampleModalLabel">Информация о сотруднике</h5>--}}
                {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                {{--                </div>--}}
                {{--                <div class="modal-body">--}}
                {{--                    @include('cms2.staff_info')--}}
                {{--                </div>--}}
                {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--        </div>--}}
                {{--    </div>--}}


            </div>
        </div>
    </div>
</div>
