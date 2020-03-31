<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Message;
use App\Models\User;
use App\Models\Reply;

class ChatContorller extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $message = Message::OrderBy('created_at', 'desc')->get();
        $reply = Reply::all();
        return view('Chat.ChatPage',compact('message','reply','user'));
    }

    public function post(Request $request){
        $user = Auth::user();
        $message = new Message(['body'=>$request->msgBody]);
        $user->Message()->save($message);
        return redirect()->route('Chat.index');
    }

    public function reply(Request $request)
    {
        $user = Auth::user();
        $reply = new Reply([
            'msg_id' =>$request->msgId,
            'body' => $request->replyBody,
        ]);
        $user->reply()->save($reply);
        return redirect()->route('Chat.index');
    }
}
