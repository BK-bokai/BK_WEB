@extends('Layouts.master')
@section('title','聊天區')
@section('chat', 'orange-text')
@section('content')
<script src="{{ asset('js/Chat.js') }}" charset="utf-8"></script>
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<style>
    .headImg {
        height: 40px;
        width: 40px;
    }

    .row {
        font-size: 20px;
    }
</style>
<div style="display:none" class="row" id='edit'>
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" class="AutoHeight materialize-textarea" cols="30" rows="10"></textarea>
            </div>
        </div>
        <button id='editBtn' type="button" class="btn waves-effect waves-light" style="margin-bottom: 2vh;">確認</button>
    </form>
</div>
<div class="row container">
    <!-- po文區 -->
    <form method="post" action="{{route('Chat.post')}}" class="col s12 post-form">
        @csrf
        <div class="col s12">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">textsms</i>
                        <textarea id="autocomplete-input" name='msgBody' class="materialize-textarea" required></textarea>
                        <label for="autocomplete-input">你想講些什麼?</label>
                    </div>
                    <div class="row ">
                        <div class="col s12">
                            <button class="btn waves-effect waves-light" type="submit">
                                post
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@foreach ($message as $msg)
<div class="row containerBody center container" id="msg_{{$msg->id}}">
    <div class="col s12 ChatBody white ">
        <div class="head row valign-wrapper" style="margin-top: 15px;">
            <div class="col s10 left-align light-blue-text text-darken-4 headName">
                {{$msg->user->name}}
            </div>
            @if($user->id == $msg->user->id)
            <div class="col s2 right-align">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger grey-text' href='#' data-target="msgDown_{{$msg->id}}"><i class="material-icons small">expand_more</i></a>

                <!-- Dropdown Structure -->
                <ul id="msgDown_{{$msg->id}}" class='dropdown-content'>
                    <li><a href="javascript:void(0);" class="delMsg" msgId="{{$msg->id}}" url="{{route('Chat.delMsg',['message'=>$msg->id])}}">刪除</a></li>
                    <li><a href="javascript:void(0);" class="editMsg" msgId="{{$msg->id}}" url="{{route('Chat.editMsg',['message'=>$msg->id])}}">編輯</a></li>
                </ul>
            </div>
            @endif
        </div>

        <div class="ChatMsg row" msgContain='{{ $msg->id }}'>
            {{$msg->body}}
        </div>
        @php
        $replyNum=count($msg->reply);
        @endphp
        <div class="ChatAct row">
            <hr class="col s12">
            <div class="col s6 replyNum">
                {{$replyNum}}則留言
            </div>
            <div class="col s6 showReply">
                <a href="javascript:void(0);" msgId="{{$msg->id}}" class="replyLink black-text">留言</a>
            </div>
            <hr class="col s12">
        </div>

        <!-- 回覆傳送區-->
        <div class="row" style="display: none;" msgId="{{$msg->id}}">
            <div class="col s12">
                <div class="row">
                    <form method="post" action='{{ route("Chat.reply") }}' class="col s12 reply-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="message_id" value="">
                        <div class="input-field col s12">
                            </label>
                            <i class="material-icons prefix">textsms</i>
                            <textarea id="replyText_{{$msg->id}}" class="materialize-textarea" name="replyBody"></textarea>
                            <label for="replyText_{{$msg->id}}">請輸入回覆內容
                        </div>
                        <input type="text" name="msgId" value="{{$msg->id}}" style='display:none'>
                        <div class="col s12 right-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">留言
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- 回覆區 -->
        @if ($replyNum > 0)
        @foreach($msg->reply as $reply )
        <div class="row" id="reply_{{$reply->id}}">
            <div class="col s2 m1 right-align">
                <span class="light-blue-text text-darken-4">{{$reply->user->name}}</span>
            </div>
            <div class="col s8 m8 left-align grey lighten-2" replyContain='{{ $reply->id }}'>
                {{$reply->body}}
            </div>
            @if($user->id == $reply->user->id)
            <div class="col s2 left-align">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger grey-text' href='#' data-target="replyDown_{{$reply->id}}"><i class="material-icons small">expand_more</i></a>

                <!-- Dropdown Structure -->
                <ul id="replyDown_{{$reply->id}}" class='dropdown-content'>
                    <li><a href="javascript:void(0);" class="delReply" replyId="{{$reply->id}}" url="{{route('Chat.delReply',['reply'=>$reply->id])}}">刪除</a></li>
                    <li><a href="javascript:void(0);" class="editReply" replyId="{{$reply->id}}" url="{{route('Chat.editReply',['reply'=>$reply->id])}}">編輯</a></li>
                </ul>
            </div>
            @endif
        </div>
        @endforeach
        @endif
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        $('.dropdown-trigger').dropdown();
    })
</script>
@endsection