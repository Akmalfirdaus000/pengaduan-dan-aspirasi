<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
      <section class="bg-white p-6 rounded-xl shadow border border-slate-200">
        @if ($complaint->status === 'resolved')
    <div class="my-6">
        <a href="{{ route('complaint.print', ['id' => $complaint->id]) }}" target="_blank"
           class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition">
            Cetak Laporan
        </a>
    </div>
@endif

    <div class="grid md:grid-cols-2 gap-y-3 gap-x-6 text-sm leading-relaxed">
        <div><span class="font-medium text-slate-600">Aduan Dari:</span> <span class="break-words">{{ $complaint->user->name }}</span></div>
        <div><span class="font-medium text-slate-600">Kategori:</span> {{ $complaint->category->name }}</div>
        <div><span class="font-medium text-slate-600">Judul:</span> {{ $complaint->title }}</div>
        <div><span class="font-medium text-slate-600">Deskripsi:</span> <span class="whitespace-pre-line break-words">{{ $complaint->description }}</span></div>
        <div><span class="font-medium text-slate-600">Lokasi:</span> {{ $complaint->location }}</div>
        <div>
            <span class="font-medium text-slate-600">Status:</span>
            <span class="inline-block px-2 py-1 text-xs rounded capitalize font-medium
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
        <div class="col-span-2">
            <span class="font-medium text-slate-600">Foto:</span>
            @if ($complaint->photo)
                <a href="{{ $complaint->photo }}" target="_blank"
                   class="text-indigo-600 underline hover:text-indigo-800 break-all">
                    Lihat Foto
                </a>
            @else
                <span class="text-slate-500">Tidak ada foto.</span>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('chat.form', ['id' => $complaint->user->id]) }}"
           class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 font-medium rounded hover:bg-emerald-200 transition">
            Kirim Pesan ke User ini
        </a>
    </div>
</section>


        {{-- Proses Aduan --}}
        <section class="bg-white p-6 rounded-xl shadow border border-slate-200">
            <h2 class="text-xl font-semibold text-slate-700 mb-4">Proses Aduan Ini</h2>
            <form action="{{ route('complaint.process', ['id' => $complaint->id]) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-600 mb-1">Ubah Status</label>
                    <select id="status" name="status" class="w-full border border-slate-300 rounded px-3 py-2 focus:ring-indigo-500">
                        <option value="pending">Pending</option>
                        <option value="in_progress">Proses Aduan</option>
                        <option value="resolved">Aduan Telah Selesai</option>
                        <option value="rejected">Tolak Aduan</option>
                        <option value="canceled">Batalkan Aduan</option>
                    </select>
                </div>
                <div>
                    <label for="note" class="block text-sm font-medium text-slate-600 mb-1">Catatan</label>
                    <textarea id="note" name="note" rows="3" class="w-full border border-slate-300 rounded px-3 py-2 focus:ring-indigo-500"></textarea>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Proses Aduan Ini
                </button>
            </form>
        </section>

        {{-- Riwayat --}}
        <section>
            <h2 class="text-xl font-semibold text-slate-700 mb-4">Riwayat Status</h2>
            <div class="space-y-3">
                @foreach ($complaint->complaintHistory as $history)
                    <div class="bg-slate-50 p-4 rounded border border-slate-200 text-sm">
                        <p><strong>Dibuat Oleh:</strong> {{ $history->changedBy->name }}</p>
                        <p><strong>Tanggal:</strong> {{ $history->created_at }}</p>
                        <p><strong>Status:</strong> {{ str_replace('_', ' ', $history->status) }}</p>
                        <p><strong>Catatan:</strong> {{ $history->note }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Komentar --}}
        <section class="bg-white p-6 rounded-xl shadow border border-slate-200">
            <h2 class="text-2xl font-semibold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fas fa-comments text-slate-500"></i> Komentar
            </h2>
            <form action="{{ route('response.add.admin') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                <textarea name="response_text" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded focus:ring-indigo-500"
                    placeholder="Tulis komentar di sini..."></textarea>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Kirim Komentar
                </button>
            </form>
            <div class="mt-6 space-y-4">
                @foreach ($complaint->responses as $response)
                    <div class="bg-slate-50 p-4 rounded shadow-sm border border-slate-200">
                        <p class="font-medium text-slate-700">{{ $response->user->name }}</p>
                        <p class="text-sm text-slate-600">{{ $response->response_text }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Navigasi Bawah --}}
        <div class="pt-6">
            <a href="{{ route('complaint') }}" class="text-indigo-600 hover:underline text-sm">
                ← Kembali ke Daftar Complaint
            </a>
        </div>

    </main>
</body>
</html>
