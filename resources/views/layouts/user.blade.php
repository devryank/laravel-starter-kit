<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="icon"
        href="https://laravel.com/img/favicon/favicon.ico"
        type="image/gif"
        sizes="16x16">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{asset('dash/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
            height: 100%;
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>

<body>
    <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                <div class="">
                    @auth
                    @if (!Auth::user()->hasRole('user'))
                    <a href="{{ url('panel/dashboard') }}"
                        class="text-muted mx-2">Dashboard</a>
                    @else
                    <a href="{{ url('profile') }}"
                        class="text-muted mx-2">Profile</a>
                    @endif
                    <a href="{{ route('logout') }}"
                        class="text-muted mx-2"
                        onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Logout</a>
                    <form method="POST"
                        id="logout-form"
                        action="{{ route('logout') }}">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-muted">Log in</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    @yield('content')

    @livewireScripts
    @stack('scripts')
</body>

</html>