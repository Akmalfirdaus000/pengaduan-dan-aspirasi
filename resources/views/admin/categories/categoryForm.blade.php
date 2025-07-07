<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | Form Kategori</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex text-slate-800">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-6">

        <h1 class="text-3xl font-semibold text-slate-700 mb-6 border-b pb-2">
            {{ isset($category->id) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
        </h1>

        {{-- Navigasi --}}
        <nav class="flex flex-wrap gap-2 mb-6 text-sm">
            <a href="{{ route('complaint.admin') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Complaint List</a>
            <a href="{{ route('category.list') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Category List</a>
            <a href="{{ route('profile') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Profile</a>
            <a href="{{ route('logout') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Logout</a>
            <a href="{{ url()->previous() }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Kembali</a>
        </nav>

        {{-- Alert --}}
        @include('components.alert')

        {{-- Form Kategori --}}
       <form action="{{ route('category.add') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-slate-200 max-w-xl">
    @csrf

    <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

    <!-- Nama Kategori -->
    <div class="mb-4">
        <label for="name" class="block font-medium text-slate-700 mb-1">Nama Kategori</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
    </div>

    <!-- Jenis Kategori -->
    <div class="mb-4">
        <label for="type" class="block font-medium text-slate-700 mb-1">Jenis Kategori</label>
        <select name="type" id="type"
            class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            <option value="">Pilih Jenis</option>
            <option value="pengaduan" {{ old('type', $category->type ?? '') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
            <option value="aspirasi" {{ old('type', $category->type ?? '') == 'aspirasi' ? 'selected' : '' }}>Aspirasi</option>
        </select>
    </div>

    <!-- Deskripsi -->
    <div class="mb-4">
        <label for="description" class="block font-medium text-slate-700 mb-1">Deskripsi</label>
        <textarea name="description" id="description" rows="4"
            class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <!-- Tombol Submit -->
    <div class="mt-6">
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white font-medium rounded hover:bg-indigo-700 transition">
            {{ isset($category->id) ? 'Update' : 'Simpan' }} Kategori
        </button>
    </div>
</form>


    </main>
</body>
</html>

