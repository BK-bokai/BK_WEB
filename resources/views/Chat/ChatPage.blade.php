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
<div class="row ">
    <!-- po文區 -->
    <form method="post" action='' class="col s12 post-form">
        @csrf
        <div class="col s12 m8 offset-m2 l6 offset-l3">
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
<div class="row containerBody center left-align">
    <div class="col s12 m8 offset-m2 l6 offset-l3 ChatBody white row">
        <div class="row">
            <div class="head row">
                <div class="col s2">
                    <img src="{{asset('imageMerchandise/tree-sea-grass-nature-451855.jpeg')}}" class="circle responsive-img headImg">
                </div>
                <div class="col s10 left-align">
                    劉博凱
                </div>
            </div>

            <div class="ChatMsg row">
                大家好
                123145
            </div>

            <div class="ChatAct row">
                <hr class="col s12">
                <div class="col s6">
                    3則留言
                </div>
                <div class="col s6">
                    留言
                </div>
                <hr class="col s12">
            </div>
        </div>
    </div>
</div>
@endsection