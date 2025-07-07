<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CompaintStatusHistoryController extends Controller
{
    public function history_list(){
        $complaints = Complaint::where('user_id', Auth::user()->id)->get();

        $historyComplaint = $complaints->map(function($complaint){
            return [
                "title" => $complaint->title,
                "created_at" => $complaint->created_at,
                "status" => $complaint->status,
                "url" => route('complaint.view', ['id' => $complaint->id]),
            ];
        });

        return view('user.complaints.historyComplaint', compact('historyComplaint'));
    }

    public function process(Request $request, $id){
        
        $valid = $request->validate([
            'status' => [
                'required',
                Rule::in(['pending', 'in_progress', 'resolved', 'rejected', 'canceled']),
            ],
        ]);

        $status = $valid['status'];

        $userId = Auth::user()->id;
        $complaint = Complaint::find($id);

        if ($status == $complaint->status) {
            return back()->with('error', 'Status Proses yang anda pilih samma dengan status Aduan Saat ini, anda tidak merubah apapun');
        }

        try {
            $complaint->status = $status;
            $complaint->save();

            ComplaintStatusHistory::create([
                'complaint_id' => $complaint->id,
                'changed_by' => $userId,
                'status' => $status,
                'note' => $request->input('note') ? $request->input('note') : null 
            ]);

            $tanggal = Carbon::parse($complaint->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY');
            
            if ($status == 'in_progress') {
                // Pengaduan dalam proses
                Notification::create([
                    "user_id" => $complaint->user->id,
                    "title" => "Pengaduan Diproses",
                    "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, saat ini sedang ditinjau oleh tim kami. Mohon menunggu, kami akan memberikan informasi lebih lanjut setelah proses selesai."
                ]);
            } elseif ($status == 'resolved') {
                // Pengaduan Selesai
                Notification::create([
                    "user_id" => $complaint->user->id,
                    "title" => "Pengaduan Diselesaikan",
                    "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, telah berhasil diselesaikan. Terima kasih atas partisipasi Anda. Jika ada masalah lebih lanjut, jangan ragu untuk menghubungi kami kembali."
                ]);
            } elseif ($status == 'rejected') {
                // Pengaduan Ditolak
                Notification::create([
                    "user_id" => $complaint->user->id,
                    "title" => "Pengaduan Ditolak",
                    "text" => "Maaf, pengaduan Anda pada $tanggal, tentang $complaint->title, tidak dapat diproses. Silakan periksa kembali informasi yang Anda kirimkan atau hubungi kami untuk bantuan lebih lanjut"
                ]);
            } elseif ($status == 'canceled') {
                // Pengaduan Dibatalkan
                Notification::create([
                    "user_id" => $complaint->user->id,
                    "title" => "Pengaduan Dibatalkan",
                    "text" => "Pengaduan Anda pada $tanggal, tentang $complaint->title, telah dibatalkan sesuai permintaan. Jika Anda ingin mengajukan pengaduan baru atau memerlukan bantuan, silakan hubungi tim kami."
                ]);
            }

            return back()->with('message', 'Status Pengaduan Berhasil di Update!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan saat mengupdate Status Aduan');
        }
    }
}
