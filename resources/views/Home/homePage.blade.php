@extends('Home.Layouts.master')
@section('title','ABC首頁')
@section('content')
<div class="row container">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image">
                <img src="{{$home->image}}">
                <span class="card-title">ABC MART</span>
            </div>
            <div class="card-content">
                <p class="text">
                    {!! nl2br(e($home->content_1 )) !!}
                </p>
                <p class="text">
                    {!! nl2br(e($home->content_2 )) !!}
                </p>
            </div>
        </div>
    </div>

    <div class="intro col s12 m6">
        <p class="text">
            {{ $home->content_3  }}
        </p>
        @foreach ($studentSkills as $skill)
        <a class="waves-effect waves-light btn"> {{ $skill['skill'] }} </a>
        @endforeach
        <hr>
        <p class="text">
            {{ $home->content_4 }}
        </p>
        @foreach ($workSkills as $skill)
        <a class="waves-effect waves-light btn"> {{ $skill['skill'] }} </a>
        @endforeach
    </div>
</div>
@endsection