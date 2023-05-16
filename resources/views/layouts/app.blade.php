<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Larvel Gallery') }}</title>

    <!-- Scripts -->
    @yield('components')
    <script type="text/javascript" src="{{ asset('js/header.js') }}" defer></script>
    @yield('scripts')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css" >
    <link rel="icon" href="{{ asset( 'images/logo.jpg' ) }}">
    <script src="https://kit.fontawesome.com/ea6d546e2a.js" crossorigin="anonymous"></script>
    @yield('styles')
    @yield( 'styles-over-index' )

</head>
<body>
    
    <x-header></x-header>

    <main class="main">
        @yield('content')
    </main>

    @yield('after-content')
</body>
</html>
