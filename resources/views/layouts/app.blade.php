<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <x-header />

        <main class="py-4">
            @yield('content')
        </main>

        @if(request()->auth)
        <script src="{{ asset('js/loginModal.js') }}"></script>
        @endif

        @if ($errors->any())
        @if($errors->has('username') || $errors->has('password'))
        <script src="{{ asset('js/loginModal.js') }}"></script>
        @else
        <script src="{{ asset('js/registerModal.js') }}"></script>
        @endif
        @endif
    </div>
</body>

</html>