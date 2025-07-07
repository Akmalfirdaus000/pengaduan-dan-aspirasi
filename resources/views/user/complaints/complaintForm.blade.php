<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

                <!-- Jenis Kategori: Pengaduan / Aspirasi -->
                <!-- Jenis (Type) -->
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
               <!-- Sub Kategori -->
<div class="space-y-4">
    <label for="category" class="text-lg font-medium text-indigo-700 flex items-center">
        <i class="fas fa-tags text-xl mr-2"></i> Sub Kategori
    </label>
    <select name="category" id="category" required
        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Pilih Sub Kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


                <!-- Judul -->
                <div class="space-y-4">
                    <label for="title" class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-heading text-xl mr-2"></i>Judul Pengaduan
                    </label>
                    <input type="text" name="title" id="title"
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
                        placeholder="Deskripsikan pengaduan Anda" required></textarea>
                </div>

                <!-- Lokasi -->
                <div class="space-y-4">
                    <label for="location" class="text-lg font-medium text-indigo-700 flex items-center">
                        <i class="fas fa-map-marker-alt text-xl mr-2"></i>Lokasi
                    </label>
                    <input type="text" name="location" id="location"
                        class="w-full p-4 border-2 border-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Masukkan lokasi kejadian" required>
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

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="w-full p-4 bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold rounded-md hover:from-green-600 hover:to-teal-600 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>

</body>
</html>
