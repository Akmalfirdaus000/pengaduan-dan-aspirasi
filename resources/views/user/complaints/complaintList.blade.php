<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Set TailwindCss -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Set Alert biar muncul kalo error -->
    @include('components.alert')
    <section class=" flex">
        @include('user.components.sidebar')

        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-semibold text-gray-900 mb-6">Daftar Pengaduan</h1>
            <p class="text-sm text-gray-600 mb-6">Halaman untuk melihat semua pengaduan yang Anda ajukan.</p>

            <!-- Navigasi -->
            <div class="mb-6 flex justify-between items-center">
                <ul class="flex space-x-6">
                    <li><a href="{{ route('complaint') }}"
                            class="text-blue-600 hover:text-blue-800 flex items-center space-x-2"><i
                                class="fas fa-list-ul"></i><span>Daftar Pengaduan</span></a></li>
                    <li><a href="{{ route('logout') }}"
                            class="text-red-600 hover:text-red-800 flex items-center space-x-2"><i
                                class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                </ul>
                <a href="{{ route('complaint.form') }}"
                    class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition duration-200 ease-in-out flex items-center space-x-2">
                    <i class="fas fa-plus-circle"></i><span>Tambahkan Pengaduan</span>
                </a>
            </div>

            <!-- Input Pencarian -->
            <div class="mb-6">
                <div class="relative">
                    <!-- Input Pencarian -->
                    <input type="text" placeholder="Cari berdasarkan kategori atau judul..."
                        class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                    <!-- Ikon Pencarian -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 pointer-events-none">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 18l6 6m2-20a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>


            <!-- Tabel Daftar Pengaduan -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full text-left table-auto">
                    <thead class="bg-gradient-to-r from-purple-500 via-blue-500 to-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-sm font-medium">No</th>
                            <th class="px-6 py-3 text-sm font-medium">Kategori</th>
                            <th class="px-6 py-3 text-sm font-medium">Judul</th>
                            <th class="px-6 py-3 text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints as $key => $complaint)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 text-sm">{{ $complaint->category->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $complaint->title }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <!-- Status dengan warna background dan ikon -->
                                    <span
                                        class="inline-flex items-center {{ $complaint->status == 'Pending' ? 'bg-yellow-500 text-white' : '' }}
                                    {{ $complaint->status == 'In Progress' ? 'bg-blue-500 text-white' : '' }}
                                    {{ $complaint->status == 'Resolved' ? 'bg-green-500 text-white' : '' }}
                                    px-4 py-1 rounded-full text-xs font-medium">
                                        <i
                                            class="fas {{ $complaint->status == 'Pending'
                                                ? 'fa-clock'
                                                : ($complaint->status == 'In Progress'
                                                    ? 'fa-cogs'
                                                    : 'fa-check-circle') }} mr-2"></i>
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm space-x-6 flex items-center">
                                    <!-- Aksi dengan ikon -->
                                    <a href="{{ route('complaint.view', ['id' => $complaint->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                                        <i class="fas fa-eye"></i><span>Lihat</span>
                                    </a>
                                    <a href="#"
                                        class="text-yellow-600 hover:text-yellow-800 flex items-center space-x-2">
                                        <i class="fas fa-edit"></i><span>Edit</span>
                                    </a>
                                    <a href="#"
                                        class="text-red-600 hover:text-red-800 flex items-center space-x-2">
                                        <i class="fas fa-trash-alt"></i><span>Hapus</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Include FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
