<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna - {{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen">

    <section class="flex">

        <!-- Sidebar -->
        {{-- @include('user.components.sidebar') --}}

        <!-- Main Content -->
        <main class="flex-1 px-6 py-10">
            @include('components.alert')

            <div class="max-w-3xl mx-auto">

                <!-- Header -->
                <h1 class="text-3xl font-bold mb-6">👤 Halaman Profil</h1>

                <!-- Informasi User -->
                <div class="bg-white p-6 rounded-xl shadow mb-8">
                    <h2 class="text-xl font-semibold mb-3">📄 Informasi Pengguna</h2>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li><span class="font-medium">Nama:</span> {{ $user->name }}</li>
                        <li><span class="font-medium">Email:</span> {{ $user->email }}</li>
                        <li><span class="font-medium">Role:</span> {{ ucfirst($user->role) }}</li>
                    </ul>
                </div>

                <!-- Form Ubah Nama -->
                <div class="bg-white p-6 rounded-xl shadow mb-8">
                    <h2 class="text-lg font-semibold mb-4">✏️ Ganti Nama</h2>
                    <form action="{{ route('profile.change.name') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block font-medium mb-1">Nama Baru</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <button type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition font-medium">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Form Ubah Password -->
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-lg font-semibold mb-4">🔒 Ganti Password</h2>
                    <form action="{{ route('profile.change.password') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="old_password" class="block font-medium mb-1">Password Lama</label>
                            <input type="password" name="old_password" id="old_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label for="new_password" class="block font-medium mb-1">Password Baru</label>
                            <input type="password" name="new_password" id="new_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block font-medium mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <button type="submit"
                            class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition font-medium">
                            Ubah Password
                        </button>
                    </form>
                </div>

            </div>
        </main>
    </section>

</body>
</html>
