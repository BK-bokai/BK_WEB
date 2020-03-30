@extends('Layouts.master')
@section('title','聊天區')
@section('content')
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
    <form method="post" action='' class="col s12 post-form">
        @csrf
        <div class="col s12">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">textsms</i>
                        <textarea id="autocomplete-input" name='msg-content' class="materialize-textarea" required></textarea>
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
<div class="row containerBody center container">
    <div class="col s12 ChatBody white ">
        <div class="head row valign-wrapper" style="margin-top: 15px;" >
            <div class="col s2 m1 right-align">
                <img src="{{asset('imageMerchandise/tree-sea-grass-nature-451855.jpeg')}}" class="circle responsive-img headImg">
            </div>
            <div class="col s10 m11 left-align light-blue-text text-darken-4">
                劉博凱
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
                        <div class="col s12">
                            <button class="btn waves-effect waves-light" type="submit">
                                留言
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
        </div>
    </div>
</div>
@endsection