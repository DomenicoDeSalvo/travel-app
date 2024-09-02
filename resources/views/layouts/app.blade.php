<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Diario di viaggio')</title>


    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Gloria+Hallelujah&display=swap" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="d-flex flex-column vh-100">

    <nav class="navbar navbar-expand navbar-light shadow-sm">
        <div class="container">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto d-flex align-items-center">
                <li class="nav-item ">
                    <a class="nav-link mb-lg-1" href="{{url('/') }}">
                        <img src="{{asset('/img/Logo_white.PNG')}}" alt="">
                    </a>
                    <li class="nav-item ">
                        <a class="nav-link mb-lg-1" href="{{url('/') }}">
                            <img src="{{asset('/img/name.png')}}" alt="">
                        </a>
                    </li>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto gap-3 d-flex align-items-center">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                </li>
                @endif
                @else
                    <li class="nav-item">
                        <span>{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.trips.index') }}"><i class="fa-solid fa-book-open"></i></a>
                    </li>
                    <a class="nav-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="d-flex justify-content-center align-items-baseline gap-4">
                <p>Sviluppato da</p>
                <a href="https://www.linkedin.com/in/domenico-de-salvo-3328a0192"> Domenico De Salvo </a>
            </div>   
        </div>
    </footer>
</body>

</html>
