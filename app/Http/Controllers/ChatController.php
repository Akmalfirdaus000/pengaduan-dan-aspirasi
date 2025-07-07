<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatText;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function new_chat(Request $request) {
        $valid = $request->validate([
            'to' => 'required',
            'message' => 'required'
        ]);

        try {
            $chating = Chat::where('to', $valid['to'])->first();
            if ($chating == null) {
                $chating = Chat::create([
                    'from' => Auth::user()->id,
                    'to' => $valid['to'],
                    'status' => 'open',
                ]);
            }
    
            ChatText::create([
                'chat_id' => $chating->id,
                'sender_id' => Auth::user()->id,
                'message' => $valid['message']
            ]);

            $chating->updated_at = now();
            $chating->save();

            return redirect()->route('chat.list')->with('message', 'Pesan berhasil terkirim');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan, coba beberapa saat lagi.\n' . $th);
        }
    }

    public function chat_list(){
        $chats = Chat::orderBy('updated_at', 'DESC')->get();
        return view('admin.chats.chatList', compact('chats'));
    }

    public function chat_form($id){
        $user = User::find($id);
        return view('admin.chats.chatForm', compact('user'));
    }

    public function chatChange($id){
        $chat = Chat::find($id);
        if ($chat->status == 'open') {
            $chat->status = 'close';
            $chat->save();
            return redirect()->back()->with('message', "Obrolan Chat Berhasil di Akhiri");
        } else {
            $chat->status = 'open';
            $chat->save();
            return redirect()->back()->with('message', "Obrolan Chat Berhasil di Buka Kembali");
        }
    }

    public function user_chat_list(){
        $chats = Chat::where('to', Auth::user()->id)->orWhere('from', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('user.components.chat', compact('chats'));
    }

    public function user_new_chat(Request $request) {
        $valid = $request->validate([
            'to' => 'required',
            'message' => 'required'
        ]);

        try {
            $chating = Chat::where('to', $valid['to'])->first();
            if ($chating == null) {
                $chating = Chat::create([
                    'from' => Auth::user()->id,
                    'to' => $valid['to'],
                    'status' => 'open',
                ]);
            }
    
            ChatText::create([
                'chat_id' => $chating->id,
                'sender_id' => Auth::user()->id,
                'message' => $valid['message']
            ]);

            $chating->updated_at = now();
            $chating->save();

            return redirect()->route('user.chat.list')->with('message', 'Pesan berhasil terkirim');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan, coba beberapa saat lagi.\n' . $th);
        }
    }
}
