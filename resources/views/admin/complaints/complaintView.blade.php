<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Aduan - {{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex">

    {{-- Sidebar --}}
    @include('components.sidebar')

    <main class="flex-1 p-8 space-y-10">

        {{-- Header --}}
        <header>
            <h1 class="text-3xl font-bold text-slate-700 border-b pb-4">Detail Aduan</h1>
        </header>

        {{-- Alert --}}
        @include('components.alert')

        {{-- Detail Aduan --}}
<section class="bg-white p-6 rounded-2xl shadow-md border border-slate-200 max-w-6xl mx-auto space-y-6">
    @if ($complaint->status === 'resolved')
        <div class="text-right">
            <a href="{{ route('complaint.print', ['id' => $complaint->id]) }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Cetak Laporan
            </a>
        </div>
    @endif

    {{-- Grid Foto & Info --}}
    <div class="grid md:grid-cols-3 gap-6">
        {{-- FOTO KIRI --}}
        <div class="bg-slate-100 border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            @if ($complaint->photo)
                <img src="{{ $complaint->photo }}" alt="Foto Aduan" class="w-full h-full object-cover aspect-[4/5]">
            @else
                <div class="flex items-center justify-center h-64 text-slate-400">
                    Tidak ada foto.
                </div>
            @endif
        </div>

        {{-- INFORMASI KANAN --}}
        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-slate-700">
            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <div>
                    <p class="font-medium text-slate-600">Aduan Dari</p>
                    <p>{{ $complaint->user->name }}</p>
                </div>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" /></svg>
                <div>
                    <p class="font-medium text-slate-600">Kategori</p>
                    <p>{{ $complaint->category->name }}</p>
                </div>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
                <div>
                    <p class="font-medium text-slate-600">Judul</p>
                    <p>{{ $complaint->title }}</p>
                </div>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>
                <div>
                    <p class="font-medium text-slate-600">Status</p>
                    <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full capitalize font-semibold
                        @switch($complaint->status)
                            @case('resolved') bg-emerald-100 text-emerald-700 @break
                            @case('in_progress') bg-yellow-100 text-yellow-800 @break
                            @case('rejected') bg-red-100 text-red-700 @break
                            @case('canceled') bg-gray-100 text-gray-700 @break
                            @default bg-indigo-100 text-indigo-700
                        @endswitch
                    ">
                        {{ str_replace('_', ' ', $complaint->status) }}
                    </span>
                </div>
            </div>

            <div class="sm:col-span-2 bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M4 4h16v16H4z" /></svg>
                <div>
                    <p class="font-medium text-slate-600">Deskripsi</p>
                    <p class="whitespace-pre-line">{{ $complaint->description }}</p>
                </div>
            </div>

            <div class="sm:col-span-2 bg-indigo-50 p-4 rounded-lg border border-indigo-100 flex gap-2 items-start">
                <svg class="w-5 h-5 mt-1 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 12 17.657 7.343 16.243 5.929 10.586 11.586 16.243 17.243z" /></svg>
                <div>
                    <p class="font-medium text-slate-600">Koordinat</p>
                    <p>{{ $complaint->location }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- PETA DI BAWAH --}}
    <div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
        <p class="font-medium text-slate-600 mb-2 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 12 17.657 7.343 16.243 5.929 10.586 11.586 16.243 17.243z"/></svg>
            Peta Lokasi
        </p>
        <div id="map" class="w-full h-64 rounded border border-slate-300"></div>
        <p class="mt-2 text-sm text-slate-500">
            <strong>Alamat:</strong> <span id="locationName">Memuat nama lokasi...</span>
        </p>
    </div>

    {{-- Tombol Kirim Pesan --}}
    <div class="text-right pt-4">
        <a href="{{ route('chat.form', ['id' => $complaint->user->id]) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white font-medium rounded hover:bg-emerald-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h12a2 2 0 012 2z" /></svg>
            Kirim Pesan ke User ini
        </a>
    </div>
</section>



<section class="bg-white p-6 rounded-2xl shadow-md border border-slate-200 space-y-8 max-w-6xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- PROSES ADUAN --}}
        <div>
            <h2 class="text-xl font-semibold text-slate-700 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" /></svg>
                Proses Aduan Ini
            </h2>

            <form action="{{ route('complaint.process', ['id' => $complaint->id]) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Ubah Status</label>
                    <select name="status"
                            class="w-full border border-slate-300 rounded px-3 py-2 focus:ring-indigo-500">
                        <option value="pending">Pending</option>
                        <option value="in_progress">Proses Aduan</option>
                        <option value="resolved">Aduan Telah Selesai</option>
                        <option value="rejected">Tolak Aduan</option>
                        <option value="canceled">Batalkan Aduan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Catatan</label>
                    <textarea name="note" rows="3"
                              class="w-full border border-slate-300 rounded px-3 py-2 focus:ring-indigo-500"></textarea>
                </div>
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Proses Aduan Ini
                </button>
            </form>
        </div>

        {{-- RIWAYAT STATUS --}}
        <div>
            <h2 class="text-xl font-semibold text-slate-700 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path d="M9 17v-2a4 4 0 018 0v2M5 10a2 2 0 104 0 2 2 0 00-4 0zm14 0a2 2 0 11-4 0 2 2 0 014 0zM9 21h6" /></svg>
                Riwayat Status
            </h2>

            <div class="space-y-3">
                @foreach ($complaint->complaintHistory as $history)
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 text-sm">
                        <p><strong>Dibuat Oleh:</strong> {{ $history->changedBy->name }}</p>
                        <p><strong>Tanggal:</strong> {{ $history->created_at }}</p>
                        <p><strong>Status:</strong>
                            <span class="inline-block px-2 py-1 rounded text-xs font-medium
                                @switch($history->status)
                                    @case('resolved') bg-emerald-100 text-emerald-700 @break
                                    @case('in_progress') bg-yellow-100 text-yellow-800 @break
                                    @case('rejected') bg-red-100 text-red-700 @break
                                    @default bg-indigo-100 text-indigo-700
                                @endswitch
                            ">
                                {{ str_replace('_', ' ', $history->status) }}
                            </span>
                        </p>
                        <p><strong>Catatan:</strong> {{ $history->note }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- KOMENTAR --}}
    <div>
        <h2 class="text-xl font-semibold text-slate-700 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24"><path d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-6l-4 4v-4H7a2 2 0 01-2-2v-2" /></svg>
            Komentar
        </h2>

        <form action="{{ route('response.add.admin') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
            <textarea name="response_text" rows="4"
                      class="w-full px-4 py-2 border border-slate-300 rounded focus:ring-indigo-500"
                      placeholder="Tulis komentar di sini..."></textarea>
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                Kirim Komentar
            </button>
        </form>

        <div class="mt-6 space-y-4">
            @foreach ($complaint->responses as $response)
                <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                    <p class="font-medium text-slate-700">{{ $response->user->name }}</p>
                    <p class="text-sm text-slate-600">{{ $response->response_text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


        {{-- Navigasi Bawah --}}
        <div class="pt-6">
            <a href="{{ route('complaint') }}" class="text-indigo-600 hover:underline text-sm">
                ← Kembali ke Daftar Complaint
            </a>
        </div>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mapDiv = document.getElementById("map");
            const locationText = document.getElementById("locationName");

            @php
                $location = explode(',', $complaint->location);
                $lat = floatval($location[0] ?? -0.947083);
                $lng = floatval($location[1] ?? 100.417181);
            @endphp

            const lat = {{ $lat }};
            const lng = {{ $lng }};

            const map = L.map(mapDiv).setView([lat, lng], 15);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(map);
            const marker = L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Aduan").openPopup();

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(res => res.json())
                .then(data => {
                    locationText.textContent = data.display_name || "Tidak ditemukan";
                })
                .catch(() => {
                    locationText.textContent = "Gagal memuat lokasi";
                });
        });
    </script>
</body>
</html>
