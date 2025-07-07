<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rekapitulasi Laporan | {{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-8 space-y-8">
        <header>
            <h1 class="text-3xl font-bold text-slate-800 border-b pb-4">Rekapitulasi Laporan Pengaduan</h1>
        </header>

        {{-- Filter Form --}}
        <section class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
            <form method="GET" action="{{ route('rekap.index') }}" class="space-y-4">
                <div class="grid md:grid-cols-4 gap-4">
                    <input
                        type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Judul atau Alamat"
                        class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    />

                    <select name="status" class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Proses</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>

                    <input type="date" name="from" value="{{ request('from') }}" class="border px-4 py-2 rounded w-full focus:ring-indigo-400" />
                    <input type="date" name="to" value="{{ request('to') }}" class="border px-4 py-2 rounded w-full focus:ring-indigo-400" />
                </div>
                <div class="pt-2">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                        Filter
                    </button>
                </div>
            </form>
        </section>

        {{-- Tabel Rekap --}}
        <section class="bg-white p-6 rounded-xl shadow-md border border-slate-200 overflow-auto">
            <table class="min-w-full border text-sm text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Judul Pengaduan</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Alamat</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Foto</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Catatan</th>
                        <th class="px-4 py-2 border">Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $i => $complaint)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-2 border">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $complaint->title }}</td>
                            <td class="px-4 py-2 border">{{ $complaint->category->name ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $complaint->location }}</td>
                            <td class="px-4 py-2 border capitalize">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    @switch($complaint->status)
                                        @case('resolved') bg-emerald-100 text-emerald-700 @break
                                        @case('in_progress') bg-yellow-100 text-yellow-700 @break
                                        @case('rejected') bg-red-100 text-red-600 @break
                                        @case('canceled') bg-gray-100 text-gray-600 @break
                                        @default bg-slate-100 text-slate-600
                                    @endswitch
                                ">
                                    {{ str_replace('_', ' ', $complaint->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($complaint->photo)
                                    <a href="{{ $complaint->photo }}" target="_blank" class="text-indigo-600 underline">Lihat</a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $complaint->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border">
                                {{ optional($complaint->complaintHistory->last())->note ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($complaint->status === 'resolved')
                                    {{ optional($complaint->complaintHistory->where('status', 'resolved')->first())->created_at->format('d-m-Y') }}
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center px-4 py-6 text-slate-500">
                                Tidak ada data laporan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
