<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Auth;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function response_add(Request $request){
        $valid = $request->validate([
            'complaint_id' => 'required|string',
            'response_text' => 'required|string',
        ]);

        try {
            Response::create([
                'complaint_id' => $valid['complaint_id'],
                'user_id' => Auth::user()->id,
                'response_text' => $valid['response_text'],
            ]);

            return back()->with('message', 'Response berhasil di tambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', 'error. '. $th);
        }
    }
}
