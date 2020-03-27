<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ChatContorller extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        return view('Chat.ChatPage',compact('user'));
    }
}
