<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} | Kirim Pesan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex text-slate-800">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-6">

        <h1 class="text-3xl font-semibold text-slate-700 mb-6 border-b pb-2">
            Kirim Pesan ke {{ $user->name }}
        </h1>

        {{-- Navigasi --}}
        <nav class="flex flex-wrap gap-2 mb-6 text-sm">
            <a href="{{ route('complaint.admin') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Complaint List</a>
            <a href="{{ route('category.list') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Category List</a>
            <a href="{{ route('chat.list') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Pesan / Chat</a>
            <a href="{{ route('profile') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Profile</a>
            <a href="{{ route('logout') }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Logout</a>
            <a href="{{ url()->previous() }}" class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100">Kembali</a>
        </nav>

        {{-- Alert --}}
        @include('components.alert')

        {{-- Form Kirim Pesan --}}
        <form action="{{ route('chat.new') }}" method="POST" class="bg-white p-6 rounded-xl shadow border border-slate-200 max-w-xl">
            @csrf

            <input type="hidden" name="to" value="{{ $user->id }}">

            <div class="mb-4">
                <label for="message" class="block font-medium text-slate-700 mb-1">Isi Pesan</label>
                <textarea name="message" id="message" rows="5"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
            </div>

            <div>
                <button type="submit"
                    class="px-4 py-2 bg-emerald-600 text-white font-medium rounded hover:bg-emerald-700 transition">
                    Kirim Pesan
                </button>
            </div>
        </form>

    </main>
</body>
</html>

