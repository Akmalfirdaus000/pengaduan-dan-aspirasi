<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

        <!-- Leaflet & Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        #map {
            height: 300px;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-100 via-indigo-200 to-purple-300">

    @include('components.alert')

    <section class="flex">
        @include('user.components.sidebar')

        <div class="max-w-xl mx-auto p-6 bg-white shadow-2xl rounded-lg mt-8 w-full">
            <h1 class="text-4xl font-bold text-center text-indigo-600 mb-6">
                <i class="fas fa-pen-alt text-xl mr-2"></i>Tambah Pengaduan
            </h1>
            <p class="text-center text-gray-700 mb-8">
                Beri kami pengaduan Anda dan kami akan menindaklanjutinya segera.
            </p>

            <div class="flex justify-between mb-6">
                <ul class="space-x-6 flex items-center">
                    <li>
                        <a href="{{ route('complaint') }}" class="text-green-600 hover:text-green-800 font-medium flex items-center">
                            <i class="fas fa-list-ul mr-2"></i>Daftar Pengaduan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800 font-medium flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('complaint.add') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                @csrf

                <!-- Jenis -->
                <!-- Jenis -->
<div class="space-y-4">
    <label for="type" class="text-lg font-medium text-indigo-700 flex items-center">
        <i class="fas fa-layer-group text-xl mr-2"></i>Jenis
    </label>
    <select name="type" id="type" required
        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Pilih Jenis</option>
        <option value="pengaduan" {{ old('type') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
        <option value="aspirasi" {{ old('type') == 'aspirasi' ? 'selected' : '' }}>Aspirasi</option>
    </select>
</div>

<!-- Sub Kategori -->
<div class="space-y-4">
    <label for="category" class="text-lg font-medium text-indigo-700 flex items-center">
        <i class="fas fa-tags text-xl mr-2"></i>Sub Kategori
    </label>
    <select name="category" id="category"
        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required disabled>
        <option value="">Pilih Sub Kategori</option>
    </select>
</div>


                <!-- Judul -->
                <div class="space-y-4">
                    <label for="title" class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-heading text-xl mr-2"></i>Judul Pengaduan
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Masukkan judul pengaduan" required>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-4">
                    <label for="description" class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-pencil-alt text-xl mr-2"></i>Deskripsi
                    </label>
                    <textarea name="description" id="description"
                        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Deskripsikan pengaduan Anda" required>{{ old('description') }}</textarea>
                </div>

                <!-- Koordinat Lokasi (Hidden) -->
                <input type="hidden" name="location" id="location" value="{{ old('location') }}">

                <!-- Peta -->
                <div class="space-y-4">
                    <label class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-map-marked-alt text-xl mr-2"></i>Lokasi Kejadian (Cari atau Klik Peta)
                    </label>
                    <div id="map" class="rounded-md border-2 border-indigo-400"></div>
                </div>

                <!-- Foto -->
                <div class="space-y-4">
                    <label for="photo" class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-image text-xl mr-2"></i>Bukti / Foto
                    </label>
                    <input type="file" name="photo" id="photo"
                        class="w-full p-4 border-2 border-indigo-400 rounded-md bg-white file:mr-4 file:py-2 file:px-4
                            file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700
                            hover:file:bg-indigo-200 transition" required>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full p-4 bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold rounded-md hover:from-green-600 hover:to-teal-600 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Leaflet JS + Geocoder -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

   <!-- Leaflet JS + Geocoder -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>



<script>
    var map = L.map('map').setView([-6.2, 106.8166], 13); // Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Fungsi reverse geocoding untuk mendapatkan nama tempat dari koordinat
    async function reverseGeocode(latlng) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`;
        try {
            const res = await fetch(url);
            const data = await res.json();
            return data.display_name || "Tidak diketahui";
        } catch (err) {
            return "Tidak diketahui";
        }
    }

    // Prompt konfirmasi lokasi dengan alamat
    async function confirmAndSetLocation(latlng) {
        const lat = latlng.lat.toFixed(6);
        const lng = latlng.lng.toFixed(6);
        const coordText = `${lat},${lng}`;

        const locationName = await reverseGeocode(latlng);

        const confirmText = `Gunakan lokasi ini?\n\nAlamat: ${locationName}\nKoordinat: ${coordText}`;
        const approved = confirm(confirmText);

        if (approved) {
            document.getElementById('location').value = coordText;

            if (marker) {
                marker.setLatLng(latlng);
            } else {
                marker = L.marker(latlng).addTo(map);
            }

            map.setView(latlng, 16);
        }
    }

    // Klik di peta
    map.on('click', function (e) {
        confirmAndSetLocation(e.latlng);
    });

    // Pencarian lokasi
    L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function (e) {
        confirmAndSetLocation(e.geocode.center);
    })
    .addTo(map);

    // Tampilkan marker lama jika ada koordinat sebelumnya
    let oldLocation = document.getElementById('location').value;
    if (oldLocation) {
        let coords = oldLocation.split(',');
        if (coords.length === 2) {
            let latlng = L.latLng(parseFloat(coords[0]), parseFloat(coords[1]));
            marker = L.marker(latlng).addTo(map);
            map.setView(latlng, 15);
        }
    }
</script>
<script>
    const allCategories = @json($categories);
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category');

    function renderCategoryOptions(selectedType) {
        categorySelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';

        if (!selectedType) {
            categorySelect.disabled = true;
            return;
        }

        const filtered = allCategories.filter(cat => cat.type === selectedType);

        filtered.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id;
            option.textContent = cat.name;
            categorySelect.appendChild(option);
        });

        categorySelect.disabled = false;

        // Coba set old value jika ada
        const oldSelected = "{{ old('category') }}";
        if (oldSelected) {
            categorySelect.value = oldSelected;
        }
    }

    // Auto render jika old('type') sudah dipilih sebelumnya
    window.addEventListener('DOMContentLoaded', function () {
        if (typeSelect.value) {
            renderCategoryOptions(typeSelect.value);
        }
    });

    // Ganti kategori saat jenis berubah
    typeSelect.addEventListener('change', function () {
        renderCategoryOptions(this.value);
    });
</script>


</body>

</html>
