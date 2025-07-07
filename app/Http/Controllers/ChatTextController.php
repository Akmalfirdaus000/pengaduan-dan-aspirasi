<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatText;
use Auth;
use Illuminate\Http\Request;

class ChatTextController extends Controller
{
    public function chatText_list($id){
        $chat = Chat::find($id);
        $messages = $chat->message;
        return view('admin.chatText.chatText', compact('messages'));
    }

    public function send_chat(Request $request){
        $valid = $request->validate([
            'chatId' => 'required',
            'message' => 'required'
        ]);

        try {    
            ChatText::create([
                'chat_id' => $valid['chatId'],
                'sender_id' => Auth::user()->id,
                'message' => $valid['message']
            ]);
            return redirect(url('admin/chat/list') . '?chatId=' . $valid['chatId'])->with('message', 'Chat Success Sended');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan, coba beberapa sat lagi');
        }
    }

    public function user_send_chat(Request $request){
        $valid = $request->validate([
            'chatId' => 'required',
            'message' => 'required'
        ]);

        try {    
            ChatText::create([
                'chat_id' => $valid['chatId'],
                'sender_id' => Auth::user()->id,
                'message' => $valid['message']
            ]);
            return redirect(url('user/chat/list') . '?chatId=' . $valid['chatId'])->with('message', 'Chat Success Sended');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan, coba beberapa sat lagi');
        }
    }
}
