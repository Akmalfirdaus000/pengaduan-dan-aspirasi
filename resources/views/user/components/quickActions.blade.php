<section class="p-6">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v8a1 1 0 11-2 0V6a1 1 0 011-1zm-2 3a1 1 0 011 1v5a1 1 0 11-2 0V9a1 1 0 011-1zm8 0a1 1 0 011 1v5a1 1 0 11-2 0V9a1 1 0 011-1zM4 9a1 1 0 011 1v5a1 1 0 11-2 0V9a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Aksi Cepat
        </h3>
        <div class="grid grid-cols-4 gap-4">
            <!-- Tombol Pengaduan dengan Route ke Halaman Pengaduan -->
            <a href="{{ route('complaint') }}"
                class="flex flex-col items-center justify-center p-4 bg-yellow-100 hover:bg-yellow-200 transition rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600 mb-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M2.166 5.6A2 2 0 014 4h12a2 2 0 011.834 1.6l1.15 4.6a2 2 0 01-.157 1.565l-2.386 4.773A2 2 0 0115.639 18H4.361a2 2 0 01-1.802-1.464l-2.385-4.773A2 2 0 01.016 10.2l1.15-4.6z" />
                </svg>
                <span class="text-sm font-semibold text-gray-800">Pengaduan</span>
            </a>

            <!-- Tombol Riwayat -->
            <a href="#"
                class="flex flex-col items-center justify-center p-4 bg-red-100 hover:bg-red-200 transition rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mb-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 112 0v2a1 1 0 11-2 0v-2zm0-8a1 1 0 012 0v4a1 1 0 11-2 0V6z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-semibold text-gray-800">Riwayat</span>
            </a>

            <!-- Tombol Pesan -->
            <a href="#"
                class="flex flex-col items-center justify-center p-4 bg-purple-100 hover:bg-purple-200 transition rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 mb-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M4 4a1 1 0 000 2h12a1 1 0 100-2H4z" />
                    <path fill-rule="evenodd" d="M4 9a1 1 0 011-1h10a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V9z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-semibold text-gray-800">Pesan</span>
            </a>

            <!-- Tombol Profil -->
            <a href="#"
                class="flex flex-col items-center justify-center p-4 bg-teal-100 hover:bg-teal-200 transition rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 mb-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M10 2a6 6 0 00-6 6v4H3a1 1 0 000 2h14a1 1 0 100-2h-1V8a6 6 0 00-6-6z" />
                </svg>
                <span class="text-sm font-semibold text-gray-800">Profil</span>
            </a>
        </div>
    </div>
</section>
