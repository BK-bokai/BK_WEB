@extends('Layouts.master')
@section('title','ABC首頁管理系統')
@section('content')
<script src="{{ asset('js/Home.js') }}" charset="utf-8"></script>

<div class="row container">
    <div class="col s12">
        <button url="" id="index_img" class="btn waves-effect waves-light">
            <i class="fas fa-images"></i>
            選擇首頁相片
        </button>
    </div>
    <form method="post" action="{{route('Home.homeUpdate')}}" class="col s12" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col s12 m6">
            <h3>左半邊</h3>
            <div class="row">
                <div class="col s12">
                    <div class="input-field col s12">
                        <textarea name="content_1" id="content_1" url="{{route('Home.checkChange')}}" class="materialize-textarea">{{ $home->content_1 }}</textarea>
                        <label for="content_1">第一段</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s12">
                        <textarea name="content_2" id="content_2" url="{{route('Home.checkChange')}}" class="materialize-textarea">{{ $home->content_2 }}</textarea>
                        <label for="content_2">第二段</label>
                    </div>

                    <button id="home_submit" class="btn waves-effect waves-light disabled"  name="action">存檔
                        <i class="fas fa-save"></i>
                    </button>
                    @if (session('status'))
                    <p class="teal-text">
                        {{ session('status') }}
                    </p>
                    @endif
                </div>
            </div>
        </div>


        <div class="col s12 m6">
            <h3>右半邊</h3>
            <div class="row">
                <div class="col s12">
                    <div class="input-field col s12">
                        <textarea name="content_3" id="content_3" url="{{route('Home.checkChange')}}" class="materialize-textarea">{{ $home->content_3 }}</textarea>
                        <label for="content_3">第一段</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s12">
                        <textarea name="content_4" id="content_4" url="{{route('Home.checkChange')}}" class="materialize-textarea">{{ $home->content_4 }}</textarea>
                        <label for="content_4">第二段</label>
                    </div>
                </div>
            </div>
        </div>
    </form>






    <div class="col s12 m6">
        <div class="row">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h4>學生時期<br>技能列表
                    </h4>
                </li>

                @foreach ($studentSkills as $skill)
                <li class="collection-item">
                    <div>{{ $skill->skill }}<a href="javascript:void(0);" class="delSkill secondary-content red-text" url="{{route('Home.delStudentSkill',['studentSkill'=>$skill->id])}}" data-id="{{ $skill->id }}"><i class="fas fa-trash"></i></a></div>
                </li>
                @endforeach


                <li class="collection-item">
                    <form id='addStudentSkill' action="{{route('Home.addStudentSkill')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input name='skill' type="text" placeholder="請輸入要新增的技能">
                            @error('skill')
                            <p class="red-text">{{ $message }}</p>
                            @enderror
                            <button class="btn waves-effect waves-light" type="submit">新增技能
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>





    <div col class="col s12 m6">
        <div class="row">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h4>工作經驗<br>技能列表
                    </h4>
                </li>

                @foreach ($workSkills as $skill)
                <li class="collection-item">
                    <div>{{ $skill->skill }}<a href="javascript:void(0);" class="delSkill secondary-content red-text" url="{{route('Home.delWorkSkill',['workSkill'=>$skill->id])}}" data-id="{{ $skill->id }}"><i class="fas fa-trash"></i></a></div>
                </li>
                @endforeach

                <li class="collection-item">
                    <form id='addWorkSkill' action="{{route('Home.addWorkSkill')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input name='skill' type="text" placeholder="請輸入要新增的技能" required>
                            @error('skill')
                            <p class="red-text">{{ $message }}</p>
                            @enderror
                            <button class="btn waves-effect waves-light" type="submit">新增技能
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</div>
@endsection