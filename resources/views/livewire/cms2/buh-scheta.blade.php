<div>
    <div class="container mx-auto">
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    {{--                <div class="col-sm-4">--}}
                    {{--                    <h3 class="mb-0">Счета</h3>--}}
                    {{--                </div>--}}
                    {{--                <div class="col-sm-4">--}}
                    {{--                    <input type="text" wire:model.live="searchTerm" placeholder="Поиск по клиенту ..."--}}
                    {{--                           class="form-control">--}}
                    {{--                </div>--}}
                    <div class="col-sm-4">
                        <livewire:Cms2.App.Breadcrumb
                            :menu="[['route'=>'buh.zakazs','name'=>'Бухгалтерия'],[ 'link'=>'no', 'name'=>'Счета']]"/>
                        {{--                    <ol class="breadcrumb float-sm-end">--}}
                        {{--                        <li class="breadcrumb-item"><a href="#">Бухгалтерия</a></li>--}}
                        {{--                        <li class="breadcrumb-item active" aria-current="page">--}}
                        {{--                            Счета--}}
                        {{--                        </li>--}}
                        {{--                    </ol>--}}
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
    </div>
</div>
