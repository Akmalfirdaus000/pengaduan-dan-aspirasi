<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Notification;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function user_dashboard(){
        $complaint = Complaint::where('user_id', Auth::user()->id)->get();
        // 'pending', 'in_progress', 'resolved', 'rejected', 'canceled'
        $pendingComplaint = $complaint->where('status', 'pending')->count();
        $inProgressComplaint = $complaint->where('status', 'in_progress')->count();
        $resolvedComplaint = $complaint->where('status', 'resolved')->count();
        $rejectedComplaint = $complaint->where('status', 'rejected')->count();
        $canceledComplaint = $complaint->where('status', 'canceled')->count();

        $totalComplaint = $complaint->count();

        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('user.dashboard', compact('totalComplaint', 'pendingComplaint', 'inProgressComplaint', 'resolvedComplaint', 'rejectedComplaint', 'canceledComplaint', 'notifications'));
    }

    public function admin_dashboard(){

        $complaint = Complaint::all();
        // 'pending', 'in_progress', 'resolved', 'rejected', 'canceled'
        $pendingComplaint = $complaint->where('status', 'pending')->count();
        $inProgressComplaint = $complaint->where('status', 'in_progress')->count();
        $resolvedComplaint = $complaint->where('status', 'resolved')->count();
        $rejectedComplaint = $complaint->where('status', 'rejected')->count();
        $canceledComplaint = $complaint->where('status', 'canceled')->count();

        $totalComplaint = $complaint->count();

        return view('admin.dashboard', compact('totalComplaint', 'pendingComplaint', 'inProgressComplaint', 'resolvedComplaint', 'rejectedComplaint', 'canceledComplaint'));
    }
}
