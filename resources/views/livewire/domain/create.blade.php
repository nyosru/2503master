<div>

    <div>
        <livewire:Cms2.App.Breadcrumb
            :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
                                ['route'=>'tech.domain.create','name'=>'Домены'],
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    @if (session()->has('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <div class="flex flex-row">

        <div class="w-1/2">
            <form wire:submit.prevent="save" style="margin-bottom: 1em;">
                <div class="inline">
                    <label for="domain">Домен</label><br/>
                    <input type="text" id="domain" wire:model.defer="domain"
                           placeholder="example.com или https://example.com"/>
                    @error('domain')
                    <div style="color: red;">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="bg-blue-200 p-2 rounded">Добавить домен</button>
            </form>
        </div>
        <div class="w-1/2">
            <h3>Ваши домены</h3>

            @if($domains->isEmpty())
                <p>Нет доменов.</p>
            @else
                <div class="flex flex-col w-[350px]">
                    <div class="flex flex-row bg-gray-200">
                        <div class="flex-1">Домен</div>
                        <div class="w-[100px]">дейсвтия</div>
                    </div>
                    @foreach($domains as $domain)
                        <div class="flex flex-row {{ $loop->iteration % 2 != 0 ? 'bg-white' : 'bg-gray-100' }}">
                            <div class="flex-1 p-1">
                                <strong>
                                    <a href="https://{{ $domain->domain }}" target="_blank">
                                        {{ $domain->domain_ru }}
                                    </a>
                                </strong>
                            </div>
                            <div class="w-[100px] p-1">
                                <a
                                    wire:confirm="Удалить домен {{ $domain->domain_ru }}? (все доски домена станут недоступны)"
                                    wire:click="deleteDomain({{ $domain->id }})"
                                    class="cursor-pointer"
                                    style="color: red; margin-left: 10px;">
                                    Удалить
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
