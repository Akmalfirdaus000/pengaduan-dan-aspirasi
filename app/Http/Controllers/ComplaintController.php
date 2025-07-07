<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use App\Models\Notification;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    public function complaint_list(){
        $complaints = Complaint::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('user.complaints.complaintList', compact('complaints'));
    }

    public function complaint_form(){
        $categories = Category::all();
        return view('user.complaints.complaintForm', compact('categories'));
    }

    public function complaint_add(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:200',
        'description' => 'required|string',
        'type' => 'required|in:pengaduan,aspirasi',
        'category' => 'required|exists:categories,id',
        'location' => 'required|string|max:255',
        'photo' => 'required|image|max:2048',
    ]);

    $file = $request->file('photo');
    $userId = Auth::id();
    $timestamp = now()->timestamp;
    $fileName = "{$userId}-{$timestamp}." . $file->getClientOriginalExtension();
    $filePath = 'complaints';

    try {
        $file->move(public_path($filePath), $fileName);
    } catch (\Throwable $th) {
        return back()->with('error', "Gagal upload foto, coba lagi nanti.");
    }

    try {
        // Opsional: pastikan category benar sesuai type
        $category = \App\Models\Category::where('id', $validated['category'])
            ->where('type', $validated['type'])
            ->first();

        if (!$category) {
            return back()->with('error', 'Kategori tidak valid untuk jenis yang dipilih.');
        }

        $complaint = Complaint::create([
            'user_id' => $userId,
            'category_id' => $category->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'photo' => "/{$filePath}/{$fileName}",
        ]);

        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->id,
            'changed_by' => $userId,
            'status' => 'pending',
            'note' => 'Aduan Dikirim Oleh User ' . Auth::user()->name
        ]);

        $tanggal = Carbon::parse($complaint->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY');
        Notification::create([
            'user_id' => $userId,
            'title' => 'Pengaduan Terkirim',
            'text' => "Terima kasih! Pengaduan Anda pada $tanggal, tentang \"{$complaint->title}\", telah berhasil dikirim dan sedang ditinjau oleh tim kami."
        ]);

        return redirect(route('complaint'))->with('message', 'Berhasil mengirim pengaduan.');
    } catch (\Throwable $th) {
        return back()->with('error', "Terjadi kesalahan. Silakan coba beberapa saat lagi.");
    }
}


    public function complaint_view($id){
        $complaint = Complaint::find($id);
        if (Auth::user()->role == 'user') {
            return view('user.complaints.complaintView', compact('complaint'));
        } else {
            return view('admin.complaints.complaintView', compact('complaint'));
        }
    }

    public function complaint_list_admin(Request $request){
        $request->validate([
            'status' => 'nullable|string', // Optional
            'start_date' => 'nullable|date', // Optional
            'end_date' => 'nullable|date|after_or_equal:start_date', // Optional
        ]);

        // Query dasar
        $query = Complaint::query();

        // Tambahkan kondisi berdasarkan input
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Eksekusi query
        $complaints = $query->orderBy('created_at', 'DESC')->get();

        return view('admin.complaints.complaintList', compact('complaints'));
    }
    public function print($id)
{
    $complaint = Complaint::with(['user', 'category', 'complaintHistory', 'responses'])->findOrFail($id);

    if ($complaint->status !== 'resolved') {
        abort(403, 'Laporan hanya bisa dicetak jika status aduan telah selesai.');
    }

    return view('admin.complaints.print', compact('complaint'));
}


public function edit($id)
{
    $complaint = Complaint::findOrFail($id);
    $categories = Category::all(); // asumsikan relasi kategori

    return view('user.complaints.edit', compact('complaint', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'location' => 'required|string',
        'photo' => 'nullable|image|max:2048',
    ]);

    $complaint = Complaint::findOrFail($id);
    $complaint->title = $request->title;
    $complaint->category_id = $request->category_id;
    $complaint->description = $request->description;
    $complaint->location = $request->location;

    if ($request->hasFile('photo')) {
        // Hapus foto lama kalau ada
        if ($complaint->photo && Storage::exists($complaint->photo)) {
            Storage::delete($complaint->photo);
        }

        $file = $request->file('photo');
        $path = $file->store('public/complaints');
        $complaint->photo = Storage::url($path);
    }

    $complaint->save();

    return redirect()->route('complaint')->with('success', 'Pengaduan berhasil diperbarui.');
}


public function destroy($id)
{
    $complaint = Complaint::findOrFail($id);

    // Hapus dulu riwayat statusnya
    $complaint->complaintHistory()->delete();

    // Baru hapus complaint-nya
    $complaint->delete();

    return redirect()->route('complaint')->with('success', 'Pengaduan berhasil dihapus.');
}


}
