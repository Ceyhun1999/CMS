<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <title>Вход в админку</title>
</head>

<body class="login-body">
    <div class="login-page">
        <div class="container">
            <div class="login-page__inner">
                <a href="https://jeywastudio.com/">
                    <img src="{{ asset('assets/admin/img/logojeywa.png') }}" alt="Logo Jeywa">
                </a>
                <div>
                    <h4 class="mb-1">Добро пожаловать в Jeywa! 👋</h4>
                    <p class="mb-6">Пожалуйста, войдите в свою учетную запись и начните редактирование.</p>
                </div>
                <form action="{{ route('authentication') }}" method="POST">
                    @csrf
                    <div class="item">
                        <label for="">Введите адрес электронной почты </label>
                        <input required type="text" class="form-control" id="email" name="email"
                            placeholder="Введите email" autofocus="">
                    </div>
                    <div class="item">
                        <label for="">Пароль</label>
                        <input required type="password" id="password" class="form-control" name="password"
                            placeholder="············" aria-describedby="password">
                    </div>

                    @if (session()->has('error'))
                        <ul class="alert alert-danger item">
                            <li>
                                {{ session('error') }}
                            </li>
                        </ul>
                    @endif

                    @if ($errors->any())
                        <ul class="alert alert-danger item">
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="item forget">
                        <div class="d-flex justify-content-between">
                            <div class="form-check mb-0">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember"> Запомнить меня </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Войти</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
