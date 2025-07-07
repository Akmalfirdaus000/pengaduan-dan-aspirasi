<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Set TailwindCss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @php
        $user = Auth::user();
    @endphp

    <!-- Sidebar and Main Content Wrapper -->
    <div class="flex min-h-screen">
        @include('user.components.sidebar')


        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Top Header -->
            <div class="flex justify-between p-2 bg-purple-600 items-center">
                <h1 class="text-center text-white">
                    Selamat Datang <b>{{ $user->name }}</b> di Dashboard Anda
                </h1>
                <div class="bg-white w-10 h-10 rounded-full">
                    <!-- User Avatar or Profile Picture -->
                </div>
            </div>

            <p class="xl:pt-3 text-gray-600 mb-6 text-center xl:font-bold xl:text-xl">
                Kami senang Anda kembali! Berikut adalah ringkasan singkat aktivitas terbaru Anda:
            </p>

            <!-- Include other components -->
            @include('user.components.overview')
            <div class="grid lg:grid-cols-2">
                <section>
                    @include('user.components.quickActions')
                </section>
                <section class="right-0">
                    @include('user.components.notifications')
                </section>
            </div>
            @include('user.components.message')

            <!-- Set Alert biar muncul kalo error -->
            @include('components.alert')

            <br><br>

            <!-- Navigasi -->
            <ul>
                <li>
                    <a href="{{ route('complaint') }}">Complaint List</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>

        </div>
    </div>
</body>

</html>
