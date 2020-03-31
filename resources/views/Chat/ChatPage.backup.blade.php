@extends('Layouts.master')
@section('title','聊天區')
@section('content')
<script src="{{ asset('js/Chat.js') }}" charset="utf-8"></script>
<style>
    .headImg {
        height: 40px;
        width: 40px;
    }

    .row {
        font-size: 20px;
    }
</style>
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
{{$msg->user->name}}
{{$msg->body}}
@if (isset($msg->reply->body))
{{$msg->reply->body}}
@endif
@endforeach
<div class="row containerBody center container">
    <div class="col s12 ChatBody white ">
        <div class="head row valign-wrapper" style="margin-top: 15px;">
            <div class="col s2 m1 right-align">
                <img src="{{asset('imageMerchandise/tree-sea-grass-nature-451855.jpeg')}}" class="circle responsive-img headImg">
            </div>
            <div class="col s8 m9 left-align light-blue-text text-darken-4">
                劉博凱
            </div>
            <div class="col s2">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger grey-text' href='#' data-target='dropdown1'><i class="material-icons small">expand_more</i></a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">刪除</a></li>
                    <li><a href="#!">編輯</a></li>
                </ul>
            </div>
        </div>

        <div class="ChatMsg row ">
            大家好
            123145
        </div>

        <div class="ChatAct row">
            <hr class="col s12">
            <div class="col s6">
                3則留言
            </div>
            <div class="col s6">

                <a href="">留言</a>
            </div>
            <hr class="col s12">
        </div>

        <!-- 回覆傳送區-->
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <form msgId="" method="post" style="" action='' class="col s12 reply-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="message_id" value="">
                        <div class="input-field col s12">
                            </label>
                            <i class="material-icons prefix">textsms</i>
                            <textarea id="reply-text" class="materialize-textarea" name="reply_content"></textarea>
                            <label for="reply-text">請輸入回覆內容
                        </div>
                        <div class="col s12 right-align">
                            <!-- <button class="btn waves-effect waves-light" type="submit">
                                留言
                            </button> -->
                            <button class="btn waves-effect waves-light" type="submit" name="action">留言
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 回覆區 -->
        <div class="row">
            <div class="col s2 m1 right-align">
                <img src="{{asset('imageMerchandise/tree-sea-grass-nature-451855.jpeg')}}" class="circle responsive-img headImg">
            </div>
            <div class="col s8 m8 left-align grey lighten-2">
                <span class="light-blue-text text-darken-4">劉博凱</span> 很棒啊
            </div>
            <div class="col s2 left-align">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger grey-text' href='#' data-target='dropdown1'><i class="material-icons small">expand_more</i></a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">刪除</a></li>
                    <li><a href="#!">編輯</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.dropdown-trigger').dropdown();
    })
</script>
@endsection