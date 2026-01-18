<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 | Слишком много запросов</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/429.css') }}">
</head>
<body>
    <div class="glow-orb glow-orb-1"></div>
    <div class="glow-orb glow-orb-2"></div>
    <div class="glow-orb glow-orb-3"></div>

    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="icon-container">
            <div class="icon">
                <div class="clock">
                    <div class="clock-center"></div>
                </div>
            </div>
        </div>

        <div class="error-code">429</div>
        
        <h1 class="title">Слишком много запросов</h1>
        
        <p class="message">
            Вы отправили слишком много запросов за короткий промежуток времени.<br>
            Пожалуйста, подождите немного перед следующей попыткой.
        </p>

        <div class="timer-container">
            <div class="timer-label">Повторите через</div>
            <div class="timer" id="countdown">01:00</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progress"></div>
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Вернуться назад
        </a>
    </div>

    <script>
        (() => {
            const totalSeconds = 60;
            let remaining = totalSeconds;
            const countdownEl = document.getElementById('countdown');
            const progressEl = document.getElementById('progress');

            const update = () => {
                const mins = Math.floor(remaining / 60).toString().padStart(2, '0');
                const secs = (remaining % 60).toString().padStart(2, '0');
                countdownEl.textContent = `${mins}:${secs}`;
                
                const percent = ((totalSeconds - remaining) / totalSeconds) * 100;
                progressEl.style.width = percent + '%';

                if (remaining > 0) {
                    remaining--;
                    setTimeout(update, 1000);
                } else {
                    countdownEl.textContent = 'Готово!';
                    countdownEl.style.color = '#00d26a';
                }
            };

            update();
        })();
    </script>
</body>
</html>
