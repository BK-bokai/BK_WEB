@extends('Layouts.master')
@section('title','編輯會員')
@section('content')
<script src="{{ asset('js/editMember.js') }}" charset="utf-8"></script>

<div class="row container containerBody">
    <form class="col s12" action="{{route('Member.Update',['member'=>$member->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="input-field col s12">
            <input url="{{route('Member.Check',['member'=>$member->id])}}" id="name" type="text" name="name" class="validate black-text" value="{{$member->name}}">
            <label for="name">
                <span>名稱</span>
            </label>
            @error('name')
            <p class="red-text">{{ $message }}</p>
            @enderror
            <p class="js_name_error red-text"></p>
        </div>

        <div class="input-field col s12">
            <input url="{{route('Member.Check',['member'=>$member->id])}}" id="email" type="text" name="email" class="validate" value="{{$member->email}}">
            <label for="email"><span>電子信箱</span></label>
            @error('email')
            <p class="red-text">{{ $message }}</p>
            @enderror
            <p class="js_email_error red-text"></p>
        </div>
        <div class="input-field col s12">
            <p>
                <label>
                    <input type="checkbox" url="{{route('Member.Check',['member'=>$member->id])}}" name='admin' class="filled-in" {{ $member->admin == 1 ? "checked" : "" }} />
                    <span>設定為管理員</span>
                </label>
                @error('admin')
                <p class="red-text">{{ $message }}</p>
                @enderror
            </p>
            @error('level')
            <p class="red-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="col s6">
            <button class="btn waves-effect waves-light test disabled" type="submit">送出
                <i class="material-icons right">send</i>
            </button>
            @if (session('status'))
            <p class="teal-text"> {{ session('status') }}
                <p>
                    @endif
        </div>
    </form>
    <h4>若想修改此使用者密碼請至<a href="{{route('Member.UpdatePwdPage',['member'=>$member->id])}}">修改密碼</a>頁面</h4>
</div>
@endsection