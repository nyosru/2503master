<div>
    @if( !$show_original_link )
        {{--    показываем ссылку с левого домена--}}
        Войти:
        <a href="{{ $link_to_auth_master_domain }}" class="inline-block">
            <div class="bg-[rgb(36,150,227)] py-1 px-3 rounded-xl text-white">
                <img src="/icon/telega/Logo.svg" class="w-6 inline"/>через Telegram
            </div>
        </a>
    @else
        {{--    показываем ссылку с оригинального домена--}}
        {!! Socialite::driver('telegram')->getButton() !!}
    @endif
</div>
