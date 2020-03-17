@extends('Member.Layouts.master')
@section('title','編輯會員')
@section('content')
<script src="{{ asset('js/editMember.js') }}" charset="utf-8"></script>

<div class="row container containerBody">

    <form class="col s12" action="" method="post">
        @csrf
        @method('PUT')
        <div class="input-field col s12">
            <input url="" id="name" type="text" name="name" class="validate black-text" value="{{$member->name}}">
            <label for="name">
                <span>名稱</span>
            </label>
            @error('name')
            <p class="red-text">{{ $message }}</p>
            @enderror
            <p class="js_name_error red-text"></p>
        </div>

        <div class="input-field col s12">
            <input url="" id="email" type="text" name="email" class="validate" value="{{$member->email}}">
            <label for="email"><span>電子信箱</span></label>
            @error('email')
            <p class="red-text">{{ $message }}</p>
            @enderror
            <p class="js_email_error red-text"></p>
        </div>
        <div class="input-field col s12">
            <select name='level' url="">
                <!-- <option value="" disabled selected>level3</option> -->
                <option value="1" {{ $member->level == 1 ? "selected" : "" }}>level1</option>
                <option value="2" {{ $member->level == 2 ? "selected" : "" }}>level2</option>
            </select>
            <label>選擇管理權限</label>
            @error('level')
            <p class="red-text">{{ $message }}</p>
            @enderror
        </div>

        <!-- <div class="row"> -->
        <div class="col s6">
            <button class="btn waves-effect waves-light test disabled" type="submit">送出
                <i class="material-icons right">send</i>
            </button>
            @if (session('status'))
            <p class="teal-text"> {{ session('status') }}
                <p>
                    @endif
        </div>



        <!-- </div> -->
    </form>
</div>
@endsection