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
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/components/header.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/components/navigation.css') }}" rel="stylesheet" type="text/css" >
    <link rel="icon" href="{{ asset( '/favicon.ico' ) }}">
    <script src="https://kit.fontawesome.com/c3b53fc9a9.js" crossorigin="anonymous"></script>
    @yield('styles')
    @yield( 'styles-over-index' )

</head>
<body>
    
    <x-navigation></x-navigation>
    <main class="main">
        <x-header></x-header>
        @yield('content')
    </main>

    @yield('after-content')
    <script type="module" src="{{ asset('js/components/header.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
    @yield('scripts')
</body>

</html>
