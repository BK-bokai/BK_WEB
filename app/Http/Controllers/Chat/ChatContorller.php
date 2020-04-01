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
    public function index(Request $request)
    {
        $user = Auth::user();
        $message = Message::OrderBy('created_at', 'desc')->get();
        $reply = Reply::all();
        return view('Chat.ChatPage', compact('message', 'reply', 'user'));
    }

    public function post(Request $request)
    {
        $user = Auth::user();
        $message = new Message(['body' => $request->msgBody]);
        $user->Message()->save($message);
        return redirect()->route('Chat.index');
    }

    public function reply(Request $request)
    {
        $user = Auth::user();
        $reply = new Reply([
            'msg_id' => $request->msgId,
            'body' => $request->replyBody,
        ]);
        $user->reply()->save($reply);
        return redirect()->route('Chat.index');
    }

    public function delMsg(Request $request, Message $message)
    {
        $message->delete();
        return $message;
    }

    public function delreply(Request $request, Reply $reply)
    {
        $reply->delete();
        return $reply;
    }

    public function editMsg(Request $request, Message $message)
    {
        $message->body = $request->body;
        $status = $message->save();
        return ['data' => $request, 'status' => $status];
    }

    public function editReply(Request $request, Reply $reply)
    {
        $reply->body = $request->body;
        $status = $reply->save();
        return ['data' => $request, 'status' => $status];
    }
}
