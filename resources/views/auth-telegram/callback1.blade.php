<html>
<head></head>
<body>
пару секунд ..
{{--<br/>--}}
{{--csrf_token: {{ csrf_token() }}--}}
<script type="text/javascript">
    // Извлекаем данные из URL (фрагмент после #)
    const hashData = window.location.hash.substring(14); // Убираем "#tgAuthResult="

    if (hashData) {
        // Отправляем данные на сервер через AJAX (Fetch API)
        // fetch('https://xn--80ajb0aifhffacm9b.xn--p1ai/api/auth/telegram/callback2', {
        // fetch('https://xn--80ajb0aifhffacm9b.xn--p1ai/auth/telegram/callback777', {
        fetch('/auth/telegram/callback777', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({tgAuthResult: hashData})
        })
            .then(response => response.json())
            .then(data => {
                console.log('Ответ сервера:', data);

                if (data.user_id) {
                    window.location.href = '/board';
                    // window.location.href = 'https://xn--80ajb0aifhffacm9b.xn--p1ai/';
                    // window.location.href = `/a/${data.user_id}`; // Используем шаблонные строки
                } else {
                    console.error('ID не получен в ответе');
                }


                // Перенаправляем на страницу "/"
                // window.location.href = 'https://xn--80ajb0aifhffacm9b.xn--p1ai/';
            })
            // .then(data => {
            //     console.log('Ответ сервера:', data)
            //     // console.log('🔹 Hash от Telegram:', data.hash )
            //     // console.log('🔹 Ожидалось:', data.expectedHash );
            //
            // })
            .catch(error => console.error('Ошибка:', error));
    }
</script>
</body>
</html>
