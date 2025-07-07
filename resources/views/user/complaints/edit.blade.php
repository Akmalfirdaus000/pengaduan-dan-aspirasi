<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan - {{ env('APP_NAME') }}</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    @include('components.alert')

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-3xl font-semibold mb-6 text-indigo-700 flex items-center gap-2">
            <i class="fas fa-edit"></i> Edit Pengaduan
        </h1>

        <form action="{{ route('complaint.update', $complaint->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Judul Pengaduan</label>
                <input type="text" name="title" value="{{ old('title', $complaint->title) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category_id"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $complaint->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description', $complaint->description) }}</textarea>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Koordinat Lokasi (Lat,Lng)</label>
                <input type="text" id="locationInput" name="location" value="{{ old('location', $complaint->location) }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <div id="map" class="w-full h-64 rounded border border-gray-300"></div>
            </div>

            <!-- Gambar -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Foto (Kosongkan jika tidak diganti)</label>
                <input type="file" name="photo" class="w-full border border-gray-300 rounded px-4 py-2">
                @if ($complaint->photo)
                    <p class="text-sm text-gray-600 mt-2">Foto saat ini:
                        <a href="{{ $complaint->photo }}" target="_blank" class="text-blue-500 underline">Lihat</a>
                    </p>
                @endif
            </div>

            <!-- Tombol -->
            <div class="mt-6">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow">
                    Simpan Perubahan
                </button>
                <a href="{{ route('complaint') }}"
                    class="ml-4 text-gray-600 hover:text-indigo-600 text-sm underline">
                    Kembali ke Daftar Pengaduan
                </a>
            </div>
        </form>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const locInput = document.getElementById('locationInput');
            let [lat, lng] = locInput.value.split(',').map(Number);

            if (isNaN(lat) || isNaN(lng)) {
                lat = -0.9471; // default koordinat Padang
                lng = 100.4172;
            }

            const map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([lat, lng], { draggable: true }).addTo(map)
                .bindPopup('Lokasi Pengaduan').openPopup();

            // Update koordinat input saat marker dipindahkan
            marker.on('moveend', (e) => {
                const { lat, lng } = e.target.getLatLng();
                locInput.value = `${lat.toFixed(6)},${lng.toFixed(6)}`;
            });

            // Klik peta untuk pindahkan marker
            map.on('click', (e) => {
                const { lat, lng } = e.latlng;
                marker.setLatLng(e.latlng);
                locInput.value = `${lat.toFixed(6)},${lng.toFixed(6)}`;
            });
        });
    </script>
</body>
</html>
