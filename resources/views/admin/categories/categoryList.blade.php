<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | Kategori</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-semibold text-slate-700 mb-6 border-b pb-2">Kategori Aduan</h1>

        {{-- Navigasi Aksi --}}
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <a href="{{ route('category.form') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Buat Kategori Baru
            </a>
            <a href="{{ route('complaint.admin') }}" class="text-sm text-indigo-600 hover:underline">⮐ Kembali ke Complaint List</a>
        </div>

        {{-- Menu Navigasi Tambahan --}}
        <nav class="flex flex-wrap gap-2 mb-6 text-sm">
            <a href="{{ route('complaint.admin') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Complaint List</a>
            <a href="{{ route('category.list') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Category List</a>
            <a href="{{ route('profile') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Profile</a>
            <a href="{{ route('logout') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Logout</a>
            <a href="{{ url()->previous() }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Kembali</a>
        </nav>

        {{-- Alerts --}}
        @include('components.alert')

        {{-- Tabel Kategori --}}
        <div class="overflow-x-auto bg-white p-6 rounded-xl shadow border border-slate-200">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-300">
                        <th class="px-4 py-2 font-semibold text-slate-600">Nama</th>
                        <th class="px-4 py-2 font-semibold text-slate-600">Deskripsi</th>
                        <th class="px-4 py-2 font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">{{ $category->description }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('category.form', ['id' => $category->id]) }}"
                                   class="text-indigo-600 hover:underline">Edit</a>
                                <a href="{{ route('category.delete', ['id' => $category->id]) }}"
                                   class="text-red-600 hover:underline"
                                   onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-slate-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>

