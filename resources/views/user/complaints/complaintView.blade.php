<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Lightbox -->
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        #map {
            height: 250px;
        }
    </style>
</head>

<body class="bg-white text-gray-800">
<section class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('user.components.sidebar')
    @include('components.alert')

    <div class="md:p-4 bg-white min-h-screen flex-1">
        <div class="mx-auto p-1 lg:p-5 shadow-lg rounded-lg overflow-hidden">
            <div class="flex justify-end pr-10">
                <a href="javascript:history.back()"
                   class="flex items-center w-32 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>

            <!-- Complaint Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <!-- Complaint Image -->
                <div class="p-3">
                    <a href="{{ $complaint->photo }}" data-lightbox="complaint-image">
                        <img src="{{ $complaint->photo }}" alt="Complaint Image"
                             class="object-cover w-full h-96 rounded-lg shadow-md">
                    </a>
                </div>

                <!-- Complaint Info -->
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-5">{{ $complaint->title }}</h1>

                    <!-- Category -->
                    <div class="flex items-center mb-4 text-sm text-gray-700">
                        <i class="fas fa-tag text-indigo-500 mr-2"></i>
                        <span><strong>Kategori:</strong> {{ $complaint->category->name }}</span>
                    </div>

                    <!-- Created At -->
                    <div class="flex items-center mb-4 text-sm text-gray-700">
                        <i class="fas fa-clock text-amber-500 mr-2"></i>
                        <span><strong>Diajukan pada:</strong> {{ $complaint->created_at->format('Y-m-d H:i') }}</span>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">📄 Deskripsi</h2>
                        <p class="text-gray-700">{{ $complaint->description }}</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4 flex items-center">
                        <h2 class="text-lg font-semibold mr-4">📌 Status Saat Ini:</h2>
                        <div
                            class="inline-flex items-center
                            {{ $complaint->status == 'Pending'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($complaint->status == 'In Progress'
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-green-100 text-green-800') }}
                            text-sm font-semibold px-4 py-1 rounded-full">
                            <i
                                class="fas {{ $complaint->status == 'Pending'
                                    ? 'fa-clock'
                                    : ($complaint->status == 'In Progress'
                                        ? 'fa-spinner fa-spin'
                                        : 'fa-check-circle') }} mr-2"></i>
                            {{ $complaint->status }}
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <div class="flex items-center mb-1">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                            <h2 class="text-lg font-semibold">Lokasi</h2>
                        </div>
                        <p class="text-gray-700 mb-2"><span class="font-medium">Koordinat:</span> {{ $complaint->location }}</p>
                        <p id="reverseAddress" class="text-sm text-gray-500 italic mb-2">Memuat alamat...</p>
                        <div id="map" class="rounded border border-gray-300 shadow"></div>
                    </div>
                </div>
            </div>

            <!-- Status History and Comments -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                <!-- Status History -->
                <section class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 flex items-center space-x-2 text-indigo-600">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Status</span>
                    </h2>
                    <div class="space-y-4">
                        @foreach ($complaint->complaintHistory as $statusHistory)
                            <div class="flex items-start bg-gray-100 p-4 rounded-lg shadow hover:shadow-md transition">
                                <i class="fas fa-user-circle text-gray-500 text-3xl mr-4"></i>
                                <div class="text-sm">
                                    <p class="text-gray-800"><span class="font-semibold">Dibuat Oleh:</span> {{ $statusHistory->changedBy->name }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Tanggal:</span> {{ $statusHistory->created_at }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Status:</span> {{ $statusHistory->status }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Deskripsi:</span> {{ $statusHistory->note }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Comment Section -->
                <section class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 flex items-center space-x-2 text-emerald-600">
                        <i class="fas fa-comments"></i>
                        <span>Komentar</span>
                    </h2>
                    <form action="{{ route('response.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                        <textarea name="response_text" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                  placeholder="Tulis komentar di sini..."></textarea>
                        <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-lg flex items-center space-x-2 hover:bg-emerald-700 transition">
                            <i class="fas fa-paper-plane"></i>
                            <span>Kirim Komentar</span>
                        </button>
                    </form>
                    <div class="space-y-4 mt-6">
                        @foreach ($complaint->responses as $response)
                            <div class="flex items-start bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition">
                                <i class="fas fa-user-circle text-gray-500 text-3xl mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $response->user->name }}</p>
                                    <p class="text-gray-700">{{ $response->response_text }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const location = "{{ $complaint->location }}";

        if (location) {
            const coords = location.split(',');
            if (coords.length === 2) {
                const lat = parseFloat(coords[0]);
                const lng = parseFloat(coords[1]);

                const map = L.map('map').setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                const marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('Lokasi Pengaduan').openPopup();

                // Reverse Geocoding (Nominatim)
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('reverseAddress').textContent = data.display_name || "Alamat tidak ditemukan";
                    })
                    .catch(() => {
                        document.getElementById('reverseAddress').textContent = "Gagal mengambil alamat.";
                    });
            }
        }
    });
</script>

</body>
</html>
