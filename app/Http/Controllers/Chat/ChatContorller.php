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
        $user = Auth::user();
        $msgUser = $message->user;
        if($user == $msgUser or $user->admin){
            $message->delete();
            return $message;
        }
        else{
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(405);
        }

    }

    public function delreply(Request $request, Reply $reply)
    {
        $user = Auth::user();
        $replyUser = $reply->user;
        if($user == $replyUser or $user->admin){
            $reply->delete();
            return $reply;
        }
        else{
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(405);
        }        

    }

    public function editMsg(Request $request, Message $message)
    {
        $user = Auth::user();
        $message->body = $request->body;
        $status = $message->save();
        return ['data' => $request, 'status' => $status];
    }

    public function editReply(Request $request, Reply $reply)
    {
        $user = Auth::user();
        $reply->body = $request->body;
        $status = $reply->save();
        return ['data' => $request, 'status' => $status];
    }
}
