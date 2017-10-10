<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Faktury') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,700" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    @guest
        <app v-bind:current-user="{}"></app>
    @else
        <app v-bind:current-user="{{ Auth::user()->toJson() }}"></app>
    @endguest

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    @yield('pagescripts')
</body>
</html>
