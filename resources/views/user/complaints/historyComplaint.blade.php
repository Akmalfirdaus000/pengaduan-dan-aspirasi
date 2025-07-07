<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <section class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('user.components.sidebar')

        @php
            setlocale(LC_TIME, 'id_ID.utf8');
        @endphp

        {{-- Main Content --}}
        <main class="flex-1 px-6 py-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-6 border-b pb-2">📄 Riwayat Pengaduan</h1>

            @if(count($historyComplaint) > 0)
                <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($historyComplaint as $history)
                        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 transition hover:shadow-lg">
                            <h2 class="text-lg font-semibold text-blue-800 mb-2">{{ $history['title'] }}</h2>

                            <div class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">🕒 Dibuat Pada:</span>
                                {{ date('l, d F Y', strtotime($history['created_at'])) }}
                            </div>

                            <div class="text-sm mb-4">
                                <span class="font-medium text-gray-600">📌 Status:</span>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $history['status'] == 'Selesai'
                                        ? 'bg-green-100 text-green-700'
                                        : ($history['status'] == 'Diproses'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($history['status']) }}
                                </span>
                            </div>

                            <a href="{{ $history['url'] }}"
                               class="inline-flex items-center text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">
                                🔍 Lihat Pengaduan
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500 text-center py-10 italic">
                    Belum ada riwayat pengaduan yang tercatat.
                </div>
            @endif
        </main>
    </section>
</body>
</html>
