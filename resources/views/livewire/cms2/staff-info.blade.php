<div class="container mx-auto">


    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-4">

                    <livewire:Cms2.App.Breadcrumb :menu="[['route'=>'staff.index','name'=>'Сотрудники'],[ 'link'=>'no', 'name'=>$staff->name]]" />


{{--                    --}}{{--                    <h3 class="mb-0">Клиенты</h3>--}}
{{--                    <ol class="breadcrumb xfloat-sm-end">--}}
{{--                        <li class="breadcrumb-item"><a href="/">Marudi</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Сотрудники</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="{{ route('staff.info',[ 'staff'=>$staff->id  ]) }}">{{ $staff->name }}</a></li>--}}
{{--                        --}}{{--                        <li class="breadcrumb-item active" aria-current="page">--}}
{{--                        --}}{{--                            Заказы--}}
{{--                        --}}{{--                        </li>--}}
{{--                    </ol>--}}
                </div>
                <div class="col-sm-4">
                    {{--                    <input type="text" wire:model.live="searchTerm" placeholder="Поиск по клиенту ..."--}}
                    {{--                           class="form-control">--}}
                </div>
                <div class="col-sm-4">
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->

    <div class="container mx-auto">
    {{--    <pre>{{ print_r($staff) }}</pre>--}}
<table>
    @foreach( $polya as $p => $option )
        <tr>
            <td>{{ $p ?? '-' }}</td>
            <td>
                @if( !empty($option['type']) && $option['type'] == 'number1' )
                    <input type="number" name="{{ $p }}" value="{!! $staff->$p ?? '' !!}"/>
                @elseif( !empty($option['type']) && $option['type'] == 'bool' )
{{--                    {{ $p ?? '-' }} /--}}
{{--                    {{ $staff->$p ?? '--'  }} /--}}
                    <label><input type="radio" name="{{ $p }}" value="1"
                                  @if( $staff->$p == true ) checked @endif
                        />&nbsp;вкл</label>
                    <label><input type="radio" name="{{ $p }}" value="0"
                                  @if( $staff->$p != true  )
                                      checked
                            @endif
                        />&nbsp;выкл</label>
                @else
                    <input type="text" name="{{ $p ?? '-' }}" value="{!! $staff->$p ?? '' !!}"/>
                @endif
            </td>
        </tr>
    @endforeach
</table>
</div>
</div>
