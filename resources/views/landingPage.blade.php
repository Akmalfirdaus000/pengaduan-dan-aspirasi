<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Set TailwindCss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('user.components.compLanding.navbar')
    @include('user.components.compLanding.hero')
    @include('user.components.compLanding.aboutWe')
    @include('user.components.compLanding.team')
    @include('user.components.compLanding.cta')
    @include('user.components.compLanding.services')
    @include('user.components.compLanding.location')
    @include('user.components.compLanding.footer')

    <!-- Kalo User Udah Login, Tampilin button 'Dashboard' -->
    @auth
        <a href="{{ route('user.dashboard') }}">Dashboard</a>

        <!-- Kalo User Belum Login, Tampilin button Login dan Register -->
    @else
        <!-- buat ngarahin ke halaman login & register pake kek gini -->
        <a href="{{ route('login') }}">Login</a>
        <br>
        <a href="{{ route('register') }}">register</a>
    @endauth


</body>

</html>
