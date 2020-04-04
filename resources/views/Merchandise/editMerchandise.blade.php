@extends('Merchandise.Layouts.master')
@section('title','編輯商品')
@section('merchandiseAdmin', 'orange-text')
@section('content')
<script src="{{ asset('js/member.js') }}" charset="utf-8"></script>

<div class="row container containerBody">
    <h1>編輯商品</h1>

    <form action="{{route('Merchandise.Update', ['merchandise' => $merchandise->id])}}" method="post" enctype="multipart/form-data" >
        <!-- 隱藏方法欄位 -->
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="row">
            商品狀態：
            <select name="status">
                <option value="C" @if(old('status', $merchandise->status) == 'C')
                    selected
                    @endif
                    >建立中</option>
                <option value="S" @if(old('status', $merchandise->status) == 'S')
                    selected
                    @endif
                    >可販售</option>
            </select>
            @error('status')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品名稱：
            <input type="text" name="name" placeholder="商品名稱" value="{{ old('name', $merchandise->name) }}" />
            @error('name')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品英文名稱：
            <input type="text" name="name_en" placeholder="商品英文名稱" value="{{ old('name_en', $merchandise->name_en) }}" />
            @error('name_en')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品介紹：
            <input type="text" name="introduction" placeholder="商品介紹" value="{{ old('introduction', $merchandise->introduction) }}" />
            @error('introduction')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品英文介紹：
            <input type="text" name="introduction_en" placeholder="商品英文介紹" value="{{ old('introduction_en', $merchandise->introduction_en) }}" />
            @error('introduction_en')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品照片：
            <div class="file-field input-field">
                <div class="btn">
                    <span>商品照片</span>
                    <input name='photo' type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <img class="responsive-img" src="{{ $merchandise->photo ?? asset('imageMerchandise/default-merchandise.jpg') }}" />
            @error('photo')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品價格：
            <input type="text" name="price" placeholder="商品價格" value="{{ old('price', $merchandise->price) }}" />
            @error('price')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>

        <div class="row">
            商品剩餘數量：
            <input type="text" name="remain_count" placeholder="商品剩餘數量" value="{{ old('remain_count', $merchandise->remain_count) }}" />
            @error('remain_count')
            <p class="red-text" style='color:red;'> {{ $message }} </p>
            @enderror
        </div>
        <div class="row">
            <button type="submit" class="btn btn-default">更新商品資訊</button>
        </div>

        <!-- 自動產生 csrf_token 隱藏欄位-->

    </form>
</div>

@endsection