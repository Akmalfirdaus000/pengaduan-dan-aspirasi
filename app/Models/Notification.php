<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

// // Pengaduan sukses di buat
// Notification::create([
//     "user_id" => Auth::user()->id,
//     "title" => "Pengaduan Terkirim",
//     "text" => "Terima kasih! Pengaduan Anda telah berhasil terkirim dan saat ini sedang dalam proses peninjauan oleh tim kami. Kami akan segera memberikan tanggapan terkait laporan Anda."
// ]);

// // Pengaduan dalam proses
// Notification::create([
//     "user_id" => Auth::user()->id,
//     "title" => "Pengaduan Diproses!",
//     "text" => "Pengaduan Anda saat ini sedang ditinjau oleh tim kami. Mohon menunggu, kami akan memberikan informasi lebih lanjut setelah proses selesai."
// ]);

// // Pengaduan Ditolak
// Notification::create([
//     "user_id" => Auth::user()->id,
//     "title" => "Pengaduan Ditolak",
//     "text" => "Maaf, pengaduan Anda tidak dapat diproses. Silakan periksa kembali informasi yang Anda kirimkan atau hubungi kami untuk bantuan lebih lanjut"
// ]);

// // Pengaduan Selesai
// Notification::create([
//     "user_id" => Auth::user()->id,
//     "title" => "Pengaduan Diselesaikan",
//     "text" => "Pengaduan Anda telah berhasil diselesaikan. Terima kasih atas partisipasi Anda. Jika ada masalah lebih lanjut, jangan ragu untuk menghubungi kami kembali."
// ]);

// // Pengaduan Dibatalkan
// Notification::create([
//     "user_id" => Auth::user()->id,
//     "title" => "Pengaduan Dibatalkan",
//     "text" => "Pengaduan Anda telah dibatalkan sesuai permintaan. Jika Anda ingin mengajukan pengaduan baru atau memerlukan bantuan, silakan hubungi tim kami."
// ]);