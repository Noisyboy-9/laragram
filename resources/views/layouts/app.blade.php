<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', config('app.name', 'LARAGRAM') )</title>
</head>
<body>

    <nav class="nav">

    <div class="nav__container">
        <a class="nav__link" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a> <!-- LOGO LINK -->

        <div class="nav__content">
            <!-- Left Side Of Navbar -->
            <ul class="nav__left">
                <li class="nav__item">
                    <a class="nav__link" href="/">Home</a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="/posts">Posts</a>
                </li>
            </ul>

            <ul class="nav__right">
                @guest
                    <li class="nav__item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav__item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif

                @else
                    <li class="nav__item">
                        <a class="nav__link" href="#">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
