<html>
<body>
пару секунд ..
<script>
    // Извлекаем данные из URL (фрагмент после #)
    const hashData = window.location.hash.substring(14); // Убираем "#tgAuthResult="

    if (hashData) {
        // Отправляем данные на сервер через AJAX (Fetch API)
        fetch('https://процессмастер.рф/api/auth/telegram/callback2', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                {{--'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
            },
            body: JSON.stringify({tgAuthResult: hashData})
        })
            .then(response => response.json())
            .then(data => {
                console.log('Ответ сервера:', data);
                // Перенаправляем на страницу "/"
                window.location.href = 'https://процессмастер.рф/';
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
