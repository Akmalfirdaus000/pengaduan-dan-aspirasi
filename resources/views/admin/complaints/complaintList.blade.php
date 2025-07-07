<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }} - Complaint List</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6">

        <!-- Alert -->
        @include('components.alert')

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-2">Daftar Komplain</h1>
            <p class="text-gray-600">Kelola dan pantau semua komplain pengguna</p>
        </div>

        <!-- Filter Form -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <form action="" method="get" class="space-y-4">
                <h2 class="text-xl font-semibold mb-2">Filter Komplain</h2>

                <div class="grid sm:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block font-medium mb-1">Status</label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progres" {{ request('status') == 'in_progres' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="block font-medium mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                               class="w-full border-gray-300 rounded px-3 py-2" />
                    </div>

                    <div>
                        <label for="end_date" class="block font-medium mb-1">Hingga Tanggal</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                               class="w-full border-gray-300 rounded px-3 py-2" />
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Terapkan Filter</button>
                    <a href="{{ url()->current() }}" class="border border-red-500 text-red-500 px-4 py-2 rounded hover:bg-red-50">Reset</a>
                </div>
            </form>
        </div>

        <!-- Tabel Komplain -->
       <!-- Tabel Komplain -->
<div class="bg-white p-4 rounded shadow overflow-x-auto">
    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-gray-100 text-sm font-semibold">
            <tr>
                <th class="border px-4 py-2 text-left">Judul</th>
                <th class="border px-4 py-2 text-left">Tipe</th>
                <th class="border px-4 py-2 text-left">Kategori</th>
                <th class="border px-4 py-2 text-left">Tanggal</th>
                <th class="border px-4 py-2 text-left">Status</th>
                <th class="border px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse ($complaints as $complaint)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $complaint->title }}</td>
                    <td class="border px-4 py-2 capitalize">
                        @if ($complaint->type === 'aspirasi')
                            <span class="inline-block px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-medium">Aspirasi</span>
                        @else
                            <span class="inline-block px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-medium">Pengaduan</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $complaint->category->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $complaint->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2 capitalize">
                        {{ str_replace('_', ' ', $complaint->status) }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('complaint.view.admin', ['id' => $complaint->id]) }}"
                           class="text-blue-600 hover:underline">Lihat</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data komplain.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    </main>
</body>
</html>
