<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $complaint = Complaint::first();


        $tanggal = Carbon::parse($complaint->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY');

        // // Pengaduan sukses di buat
        Notification::create([
            "user_id" => $user->id,
            "title" => "Pengaduan Terkirim",
            "text" => "Terima kasih! Pengaduan Anda pada $tanggal, tentang $complaint->title, telah berhasil terkirim dan saat ini sedang dalam proses peninjauan oleh tim kami. Kami akan segera memberikan tanggapan terkait laporan Anda."
        ]);

        // Pengaduan dalam proses
        Notification::create([
            "user_id" => $user->id,
            "title" => "Pengaduan Diproses",
            "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, saat ini sedang ditinjau oleh tim kami. Mohon menunggu, kami akan memberikan informasi lebih lanjut setelah proses selesai."
        ]);

        // Pengaduan Ditolak
        Notification::create([
            "user_id" => $user->id,
            "title" => "Pengaduan Ditolak",
            "text" => "Maaf, pengaduan Anda pada $tanggal, tentang $complaint->title, tidak dapat diproses. Silakan periksa kembali informasi yang Anda kirimkan atau hubungi kami untuk bantuan lebih lanjut"
        ]);

        // Pengaduan Selesai
        Notification::create([
            "user_id" => $user->id,
            "title" => "Pengaduan Diselesaikan",
            "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, telah berhasil diselesaikan. Terima kasih atas partisipasi Anda. Jika ada masalah lebih lanjut, jangan ragu untuk menghubungi kami kembali."
        ]);

        // Pengaduan Dibatalkan
        Notification::create([
            "user_id" => $user->id,
            "title" => "Pengaduan Dibatalkan",
            "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, telah dibatalkan sesuai permintaan. Jika Anda ingin mengajukan pengaduan baru atau memerlukan bantuan, silakan hubungi tim kami."
        ]);
        
        
    }
}

