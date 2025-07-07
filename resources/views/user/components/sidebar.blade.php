<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <!-- Sidebar Container -->
        <div id="sidebar"
            class="lg:block w-64 bg-purple-600 text-white max-h-full p-5 transition-all duration-300 ease-in-out">
            <h2 class="text-xl font-bold text-center mb-6 ">Kelurahan Lubuk Buaya </h2>
            {{-- <img src="/" alt=""> --}}
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('complaint') }}"
                        class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('history.list') }}" class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-history"></i>
                        <span>Riwayat</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.chat.list')}}" class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-comments"></i>
                        <span>Pesan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center space-x-3 hover:bg-teal-500 p-2 rounded">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Button to toggle sidebar on small screen -->
    <button id="menuToggle" class="lg:hidden fixed top-4 left-4 p-3 text-white bg-yellow-500 rounded">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Toggle Sidebar JS -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>

</body>

</html>
