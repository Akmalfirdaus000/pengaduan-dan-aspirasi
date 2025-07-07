<aside class="w-64 bg-gradient-to-b from-indigo-700 to-indigo-800 shadow-lg p-6 hidden md:block min-h-screen">
    <a href="/admin/dashboard" class="text-2xl font-bold text-white mb-8 text-center flex justify-center mx-auto tracking-wide">Panel Admin</a>
    <ul class="space-y-2 text-base font-medium">
        <li>
            <a href="{{ route('complaint.admin') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               📋 <span>Daftar Aduan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('category.list') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               📂 <span>Daftar Kategori</span>
            </a>
        </li>
        <li>
            <a href="{{ route('chat.list') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               💬 <span>Obrolan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('rekap.index') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               📊 <span>Rekap Aduan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               👤 <span>Profil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-red-300 hover:bg-red-100 hover:text-red-700 transition">
               🚪 <span>Keluar</span>
            </a>
        </li>
        <li>
            <a href="{{ url()->previous() }}"
               class="flex items-center gap-3 px-5 py-3 rounded-lg text-white hover:bg-indigo-600 transition">
               🔙 <span>Kembali</span>
            </a>
        </li>
    </ul>
</aside>
