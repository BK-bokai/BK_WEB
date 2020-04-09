@extends('Layouts.master')
@section('title','首頁相片')
@section('homeAdmin', 'orange-text')

@section('content')
<script src="{{ asset('js/homeImage.js') }}" charset="utf-8"></script>
<link rel="stylesheet" href="{{ asset('css/homeImage.css') }}">

<!-- 新增相片表單 -->
<div class="row container">
  <form id="addImg" action="{{route('Home.Create')}}" method="post" class="col s12" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="file-field input-field">
      <div class="btnEdit btn blue-grey lighten-5">
        <span class="black-text">照片</span>
        <input type="file" name="image" accept="image/gif, image/jpeg, image/png" required>
      </div>

      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    @error('image')
    <p class="red-text">{{ $message }}</p>
    @enderror
    <button class="btn waves-effect waves-light" type="submit" name="action">
      <i class="fas fa-images"></i>
      新增相片
    </button>

  </form>
</div>
<hr>
<!-- 修改相片表單 -->

<div class="row container">
  <form action='' method="post" enctype="multipart/form-data">
    @foreach ($images as $image)
    <div class="img_box col s12 m3" id="Img{{$image->id}}">

      <div class="col s12">
        <img class="responsive-img" src='{{ asset($image->image) }}'>
      </div>

      <div class="col s12">
        <label>
          <input data-id="{{ $image->id }}" id="radio{{$image->id}}" class="with-gap index_img" name="index_img" url="{{route('Home.Publish',['image'=>$image->id])}}" type="radio" value="1" {{ $image->publish ? "checked" : "" }}>
          <span>首頁相片</span>
        </label>
      </div>

      <div class="col s12 center">
        <button class="btn waves-effect waves-light red delImg" dataId="{{ $image->id }}" url="{{route('Home.delImg',['image'=>$image->id])}}" delete='{{ $image->publish ? False : True }}' type="button">刪除
          <i class="fas fa-trash-alt"></i>
        </button>
      </div>

    </div>
    @endforeach
  </form>
</div>
@endsection