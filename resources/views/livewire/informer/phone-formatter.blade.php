<span>

    @if(strlen($phone) > 14 && strlen(preg_replace('/\D/', '', $phone)) == 11)
        @if( substr(preg_replace('/\D/', '', $phone),0,2) == '89' )
            <a class="link"
               href="tel:+79{{ substr(preg_replace('/\D/', '', $phone),2,9) }}">{{ $phone }}</a>
        @else
            <a class="link" href="tel:{{ (preg_replace('/\D/', '', $phone)[0] == 7 ? '+':'' ).preg_replace('/\D/', '', $phone) }}">{{ $phone }}</a>
        @endif
    @elseif(strlen(preg_replace('/3452\D/', '', $phone)) == 10)
        <a class="link"
           href="tel:+73452{{ substr($phone,4,6) }}">8(3452){{ substr($phone,4,2).'-'.substr($phone,6,2).'-'.substr($phone,4,2) }}</a>
    @else
        <span>{{ $phone }}</span>
    @endif

</span>
