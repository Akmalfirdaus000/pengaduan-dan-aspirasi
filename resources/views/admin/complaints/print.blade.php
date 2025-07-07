<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-black px-16 py-12 text-[14px] leading-relaxed font-sans">
 <div class="no-print my-12 ">
        <button onclick="window.print()" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Cetak Laporan
        </button>
    </div>
    {{-- Header Surat --}}
    <div class="text-center mb-6">
        <img src="/logo.jpg" alt="Logo Instansi" class="h-20 mx-auto mb-2">
        <h1 class="text-xl font-bold uppercase tracking-wide">INSTANSI PENGELOLA PENGADUAN MASYARAKAT</h1>
        <p class="text-sm">Jl. Contoh No.1, padang - Indonesia | Email: info@pengaduan.go.id | Website: {{ env('APP_URL') }}</p>
        <hr class="border-t-2 border-black my-4">
    </div>

    {{-- Nomor Surat --}}
    <div class="mb-4">
        <p><strong>Nomor</strong>: 00{{ $complaint->id }}/LAP/{{ now()->year }}</p>
        <p><strong>Lampiran</strong>: 1 (satu) Berkas</p>
        <p><strong>Perihal</strong>: Laporan Pengaduan Masyarakat</p>
    </div>

    {{-- Tujuan --}}
    <div class="mb-6">
        <p>Kepada,</p>
        <p>Yth. Pihak Terkait Penanganan Pengaduan</p>
        <p>di Tempat</p>
    </div>

    {{-- Pembuka --}}
    <p class="mb-4">Dengan hormat,</p>
    <p class="mb-6">
        Bersama ini kami sampaikan laporan pengaduan dari masyarakat sebagaimana berikut:
    </p>

    {{-- Isi Data Laporan --}}
    <table class="w-full mb-6">
        <tbody class="divide-y divide-gray-300">
            <tr>
                <td class="w-48 font-medium align-top py-2">Nama Pelapor</td>
                <td>{{ $complaint->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="font-medium align-top py-2">Kategori Aduan</td>
                <td>{{ $complaint->category->name ?? 'Tidak Ada Kategori' }}</td>
            </tr>
            <tr>
                <td class="font-medium align-top py-2">Judul Aduan</td>
                <td>{{ $complaint->title }}</td>
            </tr>
            <tr>
                <td class="font-medium align-top py-2">Deskripsi</td>
                <td class="whitespace-pre-line">{{ $complaint->description }}</td>
            </tr>
            <tr>
                <td class="font-medium align-top py-2">Lokasi Kejadian</td>
                <td>{{ $complaint->location }}</td>
            </tr>
            <tr>
                <td class="font-medium align-top py-2">Status Terakhir</td>
                <td>{{ ucfirst(str_replace('_', ' ', $complaint->status)) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Riwayat Penanganan --}}
    <div class="mb-6">
        <h3 class="font-semibold mb-2 underline">Riwayat Penanganan</h3>
        <ul class="list-disc pl-5 space-y-2">
            @foreach($complaint->complaintHistory as $history)
                <li>
                    <strong>{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i') }}</strong>
                    oleh <strong>{{ $history->changedBy->name }}</strong><br>
                    Status: <em>{{ ucfirst(str_replace('_', ' ', $history->status)) }}</em><br>
                    Catatan: {{ $history->note }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Komentar Tambahan --}}
    @if ($complaint->responses->count())
        <div class="mb-6">
            <h3 class="font-semibold mb-2 underline">Komentar Tambahan</h3>
            <ul class="list-disc pl-5 space-y-2">
                @foreach($complaint->responses as $response)
                    <li>
                        <strong>{{ $response->user->name }}</strong>: {{ $response->response_text }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Lampiran --}}
    <div class="mb-6">
        <h3 class="font-semibold mb-2 underline">Lampiran</h3>
        @if ($complaint->photo)
            <p>Untuk melihat bukti foto, silakan klik tautan di bawah ini:</p>
            <a href="{{ asset('storage/' . $complaint->photo) }}" target="_blank" class="text-blue-700 underline break-words">
                {{ asset('storage/' . $complaint->photo) }}
            </a>
        @else
            <p class="text-slate-500">Tidak ada foto terlampir.</p>
        @endif
    </div>

    {{-- Ucapan Terima Kasih --}}
    <p class="mb-6">
        Kami mengucapkan terima kasih kepada pelapor atas partisipasi dan kepeduliannya dalam menyampaikan pengaduan. Informasi yang disampaikan sangat membantu kami dalam melakukan evaluasi dan tindak lanjut yang diperlukan.
    </p>

    {{-- Tanda Tangan --}}
    <div class="mt-12 text-right">
        <p>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p class="mt-6 font-semibold underline">{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->email }}</p>
        <p class="text-xs text-gray-500">Tanda tangan digital</p>
    </div>

    {{-- Tombol Cetak --}}


</body>
</html>
